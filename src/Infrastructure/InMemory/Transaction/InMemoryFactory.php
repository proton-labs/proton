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

namespace Proton\Infrastructure\InMemory\Transaction;

use Proton\Application\Transaction\Factory;
use Proton\Application\Transaction\Transaction;

final class InMemoryFactory implements Factory
{
    public function open() : Transaction
    {
        return new InMemoryTransaction();
    }
}
