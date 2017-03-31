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

interface Extension
{
    public function dependsOn() : array;

    /**
     * Used to register services in ServiceContainer.
     *
     * @param ServiceContainer $serviceContainer
     */
    public function build(ServiceContainer $serviceContainer) : void;

    /**
     * Executed immediately after initialization of ServiceLocator
     * it's the first place where CommandExtensions can be registered.
     *
     * @param ServiceLocator $serviceLocator
     */
    public function boot(ServiceLocator $serviceLocator) : void;
}
