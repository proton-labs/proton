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

use Proton\Application\Exception\NotFoundException;

interface ServiceLocator
{
    /**
     * @param string $id
     *
     * @return mixed
     * @throws NotFoundException
     */
    public function get(string $id);

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id) : bool;
}
