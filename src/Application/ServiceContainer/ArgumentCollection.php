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

final class ArgumentCollection implements Argument
{
    /**
     * @var array
     */
    private $arguments;

    /**
     * ArgumentCollection constructor.
     *
     * @param array $arguments
     */
    public function __construct(array $arguments = [])
    {
        $this->arguments = [];
        foreach ($arguments as $argument) {
            $this->add($argument);
        }
    }

    /**
     * @param Argument $argument
     */
    public function add(Argument $argument) : void
    {
        $this->arguments[] = $argument;
    }

    /**
     * @return array
     */
    public function value() : array
    {
        return $this->arguments;
    }
}