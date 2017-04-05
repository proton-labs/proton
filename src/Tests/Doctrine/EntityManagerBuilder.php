<?php
/**
 * This file is part of the Proton package.
 *
 * (c) Andrzej Kostrzewa <protonlabs@int.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Proton\Tests\Doctrine;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Logging\SQLLogger;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;

class EntityManagerBuilder
{
    /**
     * @var array
     */
    private $mappings;

    /**
     * @var SQLLogger
     */
    private $logger;

    /**
     * @var array
     */
    private $customTypes;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * EntityManagerBuilder constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection  = $connection;
        $this->mappings    = [];
        $this->customTypes = [];
    }

    /**
     * @param $path
     * @param $namespace
     *
     * @return EntityManagerBuilder
     */
    public function registerMapping(string $path, string $namespace) : EntityManagerBuilder
    {
        $this->mappings[$path] = $namespace;
        return $this;
    }

    /**
     * @param SQLLogger $logger
     *
     * @return EntityManagerBuilder
     */
    public function registerLogger(SQLLogger $logger) : EntityManagerBuilder
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param string $typeName
     * @param string $className
     *
     * @return EntityManagerBuilder
     */
    public function registerCustomType(string $typeName, string $className) : EntityManagerBuilder
    {
        $this->customTypes[$typeName] = $className;
        return $this;
    }

    /**
     * @return EntityManager
     * @throws \InvalidArgumentException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function build() : EntityManager
    {
        $driver = new SimplifiedYamlDriver($this->mappings);
        $config = Setup::createConfiguration(true);
        $config->setMetadataDriverImpl($driver);
        if ($this->logger !== null) {
            $config->setSQLLogger($this->logger);
        }

        $this->addCustomTypes();

        $entityManager = EntityManager::create($this->connection, $config);
        foreach ($this->customTypes as $customTypeName => $customTypeClass) {
            $entityManager->getConnection()
                ->getDatabasePlatform()
                ->registerDoctrineTypeMapping($customTypeName, $customTypeName);
        }

        return $entityManager;
    }

    private function addCustomTypes() : void
    {
        foreach ($this->customTypes as $customTypeName => $customTypeClass) {
            if (!Type::hasType($customTypeName)) {
                Type::addType($customTypeName, $customTypeClass);
            }
        }
    }
}
