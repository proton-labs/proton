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

use Proton\Application\Exception\KernelException;

final class Kernel
{
    /**
     * @var Extension[]
     */
    private $extensions;

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        $this->extensions = [];
    }

    /**
     * @param Extension $extension
     */
    public function register(Extension $extension) : void
    {
        $this->extensions[get_class($extension)] = $extension;
    }

    /**
     * @param ServiceContainer $container
     *
     * @throws KernelException
     */
    public function build(ServiceContainer $container) : void
    {
        foreach ($this->extensions as $extension) {
            foreach ($extension->dependsOn() as $expectedExtensionClass) {
                if (!array_key_exists($expectedExtensionClass, $this->extensions)) {
                    throw KernelException::missingExtension($expectedExtensionClass);
                }
            }
        }

        foreach ($this->extensions as $extension) {
            $extension->build($container);
        }
    }

    /**
     * @param ServiceLocator $locator
     */
    public function boot(ServiceLocator $locator) : void
    {
        foreach ($this->extensions as $extension) {
            $extension->boot($locator);
        }
    }
}
