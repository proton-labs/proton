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

namespace Proton\Infrastructure\InMemory;

use Proton\Application\Exception\NotFoundException;
use Proton\Application\ServiceLocator;

final class InMemoryServiceLocator implements ServiceLocator
{
    /**
     * @param string $id
     *
     * @throws NotFoundException
     *
     * @return mixed
     */
    public function get(string $id)
    {
        throw NotFoundException::serviceNotFound($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id) : bool
    {
        return false;
    }
}
