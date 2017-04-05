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

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

trait ORMHelper
{
    use DBALHelper;

    /**
     * @return EntityManagerBuilder
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function entityManagerBuilder() : EntityManagerBuilder
    {
        return new EntityManagerBuilder(static::createConnection());
    }

    /**
     * @param EntityManager $entityManager
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    protected function createSchema(EntityManager $entityManager) : void
    {
        $metadata     = $entityManager->getMetadataFactory()->getAllMetadata();
        $customerTool = new SchemaTool($entityManager);
        $customerTool->dropSchema($metadata);
        $customerTool->createSchema($metadata);
    }

    /**
     * @param EntityManager $entityManager
     */
    protected function dropSchema(EntityManager $entityManager) : void
    {
        $metadata     = $entityManager->getMetadataFactory()->getAllMetadata();
        $customerTool = new SchemaTool($entityManager);
        $customerTool->dropSchema($metadata);
    }
}
