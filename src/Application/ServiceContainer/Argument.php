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

namespace Proton\Application\ServiceContainer;

interface Argument
{
    /**
     * @param Argument $argument
     */
    public function add(Argument $argument) : void;

    /**
     * @return array
     */
    public function value() : array;
}
