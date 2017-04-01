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

namespace Proton\Infrastructure\Doctrine;

use Proton\Application\Exception\NotFoundException;
use Proton\Application\Extension;
use Proton\Application\ServiceContainer;
use Proton\Application\ServiceLocator;
use Proton\Application\Services;
use Proton\Infrastructure\Doctrine\ORM\Application\Transaction\ORMFactory;

final class DoctrineExtension implements Extension
{
    /**
     * @var string
     */
    private $entityManagerServiceId;

    /**
     * DoctrineExtension constructor.
     *
     * @param string $entityManagerServiceId
     */
    public function __construct(string $entityManagerServiceId)
    {
        $this->entityManagerServiceId = $entityManagerServiceId;
    }

    /**
     * @return array
     */
    public function dependsOn() : array
    {
        return [
            Extension\CoreExtension::class,
        ];
    }

    /**
     * @param ServiceContainer $serviceContainer
     *
     * @throws NotFoundException
     */
    public function build(ServiceContainer $serviceContainer) : void
    {
        $serviceContainer->register(
            Services::KERNEL_TRANSACTION_FACTORY,
            new ServiceContainer\Definition(
                ORMFactory::class,
                [
                    new ServiceContainer\ArgumentService($this->entityManagerServiceId),
                ]
            )
        );
    }

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function boot(ServiceLocator $serviceLocator) : void
    {
    }
}
