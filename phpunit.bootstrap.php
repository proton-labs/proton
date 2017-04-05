<?php
/**
 * This file is part of the Proton package.
 *
 * (c) Andrzej Kostrzewa <protonlabs@int.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/vendor/autoload.php';

define('PROTON_SRC_PATH', __DIR__ . '/src');

if (!getenv('PROTON_TEST_DB_CONNECTION')) {
    define('PROTON_TEST_DB_CONNECTION', json_encode(['driver' => 'pdo_sqlite', 'url' => 'sqlite:///:memory:', 'dbname' => 'proton']));
} else {
    define('PROTON_TEST_DB_CONNECTION', getenv('PROTON_TEST_DB_CONNECTION'));
}