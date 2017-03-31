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

namespace Proton\Application\CommandBus;

interface CommandHandlerMap
{
    /**
     * @param string $commandClass
     * @param        $handler
     */
    public function register(string $commandClass, $handler) : void;

    /**
     * @param string $commandClass
     *
     * @return mixed
     */
    public function getHandlerFor(string $commandClass);
}
