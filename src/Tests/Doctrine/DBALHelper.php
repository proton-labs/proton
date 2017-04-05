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
use Doctrine\DBAL\DriverManager;

trait DBALHelper
{
    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    protected static function createDatabase() : void
    {
        $dbParams = json_decode(PROTON_TEST_DB_CONNECTION, true);
        $config   = $dbParams;
        unset($config['dbname'], $config['path'], $config['url']);
        switch ($dbParams['driver']) {
            case 'pdo_pgsql':
            case 'pdo_mysql':
                $tmpConnection = DriverManager::getConnection($config);
                if (in_array($dbParams['dbname'], $tmpConnection->getSchemaManager()->listDatabases(), true)) {
                    return ;
                }
                $tmpConnection->getSchemaManager()->createDatabase($dbParams['dbname']);
                $tmpConnection->close();
                break;
        }
    }

    /**
     * @return Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    protected static function createConnection() : Connection
    {
        return DriverManager::getConnection(json_decode(PROTON_TEST_DB_CONNECTION, true));
    }
}
