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

namespace Proton\Application\Command;

use Proton\Application\ServiceLocator;

interface Extension
{
    /**
     * @param Command $command
     *
     * @return bool
     */
    public function expands(Command $command) : bool;

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function pre(Command $command, ServiceLocator $serviceLocator) : void;

    /**
     * @param Command        $command
     * @param ServiceLocator $serviceLocator
     */
    public function post(Command $command, ServiceLocator $serviceLocator) : void;

    /**
     * @param Command        $command
     * @param \Exception     $exception
     * @param ServiceLocator $serviceLocator
     */
    public function catchException(Command $command, \Exception $exception, ServiceLocator $serviceLocator) : void;
}