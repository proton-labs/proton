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

use Proton\Application\ServiceContainer\Definition;

interface ServiceContainer
{
    /**
     * @param string     $id
     * @param Definition $definition
     */
    public function register(string $id, Definition $definition) : void;

    /**
     * @param string $id
     *
     * @return bool
     */
    public function definitionExists(string $id) : bool;

    /**
     * @param string $id
     *
     * @return string
     */
    public function definitionClass(string $id) : string;
}
