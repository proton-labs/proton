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

namespace Proton\Tests\Context;

use Proton\Application\CommandBus;

interface CommandBusFactory
{
    /**
     * @param array $handlers
     * @param array $commandExtension
     *
     * @return CommandBus
     */
    public function create(array $handlers = [], array $commandExtension = []) : CommandBus;
}
