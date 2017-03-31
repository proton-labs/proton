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

namespace Proton\Application\Extension;

use Proton\Application\Command\ExtensionRegistry;
use Proton\Application\Exception\NotFoundException;
use Proton\Application\Extension;
use Proton\Application\Extension\Command\TransactionExtension;
use Proton\Application\ServiceContainer;
use Proton\Application\ServiceLocator;
use Proton\Application\Services;

final class CoreExtension implements Extension
{
    /**
     * @var string
     */
    private $storageServiceId;

    /**
     * CoreExtension constructor.
     *
     * @param string $storageServiceId
     */
    public function __construct(string $storageServiceId)
    {
        $this->storageServiceId = $storageServiceId;
    }

    public function dependsOn() : array
    {
        return [];
    }

    /**
     * Used to register services in ServiceContainer
     *
     * @param ServiceContainer $serviceContainer
     *
     * @throws NotFoundException
     */
    public function build(ServiceContainer $serviceContainer) : void
    {
        if (!$serviceContainer->definitionExists(Services::KERNEL_SERVICE_LOCATOR)) {
            throw NotFoundException::serviceNotFound(Services::KERNEL_SERVICE_LOCATOR);
        }

        $this->registerCommandServices($serviceContainer);
    }

    /**
     * Executed immediately after initialization of ServiceLocator
     * it's the first place where CommandExtensions can be registered.
     *
     * @param ServiceLocator $serviceLocator
     *
     * @throws NotFoundException
     */
    public function boot(ServiceLocator $serviceLocator) : void
    {
        if (!$serviceLocator->has(Services::KERNEL_TRANSACTION_FACTORY)) {
            throw NotFoundException::serviceNotFound(Services::KERNEL_TRANSACTION_FACTORY);
        }

        /** @var ExtensionRegistry $extensionRegistry */
        $extensionRegistry = $serviceLocator->get(Services::KERNEL_COMMAND_EXTENSION_REGISTRY);
        $extensionRegistry->register(
            new TransactionExtension($serviceLocator->get(Services::KERNEL_TRANSACTION_FACTORY)),
            -1024
        );
    }

    /**
     * @param ServiceContainer $serviceContainer
     */
    private function registerCommandServices(ServiceContainer $serviceContainer) : void
    {
        $serviceContainer->register(Services::KERNEL_COMMAND_EXTENSION_REGISTRY, new ServiceContainer\Definition(
            ExtensionRegistry::class,
            new ServiceContainer\ArgumentCollection(
                [new ServiceContainer\ArgumentService(Services::KERNEL_SERVICE_LOCATOR)]
            )
        ));

        $serviceContainer->register(
            Services::KERNEL_COMMAND_HANDLER_MAP,
            new ServiceContainer\Definition(
                InMemoryHandlerMap::class
            )
        );
    }
}
