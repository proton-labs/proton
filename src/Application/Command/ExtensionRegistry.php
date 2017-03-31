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

namespace Proton\Application\Command;

use Proton\Application\ServiceLocator;

final class ExtensionRegistry
{
    const EXTENSION_KEY = 'extension';
    const EXTENSION_PRIORITY_KEY = 'priority';

    /**
     * @var Extension[]
     */
    private $extensions;

    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    /**
     * @param ServiceLocator $serviceLocator
     */
    public function __construct(ServiceLocator $serviceLocator)
    {
        $this->extensions = [];
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param Extension $commandExtension
     * @param int       $priority
     */
    public function register(Extension $commandExtension, int $priority = 0) : void
    {
        $this->extensions[] = [self::EXTENSION_KEY => $commandExtension, self::EXTENSION_PRIORITY_KEY => $priority];
        if (count($this->extensions) > 1) {
            uasort($this->extensions, function ($itemA, $itemB) {
                return $itemA[self::EXTENSION_PRIORITY_KEY] <=> $itemB[self::EXTENSION_PRIORITY_KEY];
            });
        }
    }

    /**
     * @param Command $command
     */
    public function pre(Command $command) : void
    {
        $this->extensionRegisterStrategy('pre', $command);
    }

    /**
     * @param Command $command
     */
    public function post(Command $command) : void
    {
        $this->extensionRegisterStrategy('post', $command);
    }

    /**
     * @param Command    $command
     * @param \Exception $exception
     */
    public function passException(Command $command, \Exception $exception) : void
    {
        $this->extensionRegisterStrategy('exception', $command, $exception);
    }

    private function extensionRegisterStrategy(string $method, Command $command, \Exception $exception = null)
    {
        foreach ($this->extensions as $extensionItem) {
            /** @var Extension $extension */
            $extension = $extensionItem[self::EXTENSION_KEY];
            if ($extension->expands($command)) {
                switch ($method) {
                    case 'pre':
                        $extension->pre($command, $this->serviceLocator);
                        break;
                    case 'post':
                        $extension->post($command, $this->serviceLocator);
                        break;
                    case 'exception':
                    default:
                        $extension->catchException($command, $exception, $this->serviceLocator);
                        break;
                }
            }
        }
    }
}
