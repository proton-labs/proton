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

namespace Proton\Application;

final class Services
{
    const KERNEL_COMMAND_EXTENSION_REGISTRY = 'proton.command.extension_registry';
    const KERNEL_COMMAND_HANDLER_MAP = 'proton.command.handler_map';
    const KERNEL_SERVICE_LOCATOR = 'proton.service.locator';
    const KERNEL_TRANSACTION_FACTORY = 'proton.transaction.factory';
}
