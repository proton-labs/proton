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

namespace Proton\Tests\Context\Tactican;

use League\Tactician\CommandBus as TacticianCommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Proton\Application\Command\ExtensionRegistry;
use Proton\Infrastructure\InMemory\InMemoryServiceLocator;
use Proton\Infrastructure\Tactician\CommandBus;
use Proton\Tests\Context\CommandBusFactory;

final class TacticianCommandBusFactory implements CommandBusFactory
{
    /**
     * @param array $handlers
     * @param array $commandExtension
     *
     * @return \Proton\Application\CommandBus
     */
    public function create(array $handlers = [], array $commandExtension = []) : \Proton\Application\CommandBus
    {
        $commandHandlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor(),
            new InMemoryLocator($handlers),
            new HandleInflector()
        );

        $serviceLocator    = new InMemoryServiceLocator();
        $extensionRegistry = new ExtensionRegistry($serviceLocator);
        foreach ($commandExtension as $extension) {
            $extensionRegistry->register($extension);
        }

        return new CommandBus(new TacticianCommandBus([
            $commandHandlerMiddleware
        ]));
    }
}
