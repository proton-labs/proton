<?php
/**
 * This file is part of the Proton package.
 *
 * (c) Andrzej Kostrzewa <protonlabs@int.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Proton\Application\ServiceContainer;

final class Definition
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var Argument[]
     */
    private $arguments;

    /**
     * Definition constructor.
     *
     * @param string   $className
     * @param Argument $arguments
     */
    public function __construct(string $className, Argument $arguments = null)
    {
        if ($arguments === null) {
            $arguments = new ArgumentCollection();
        }

        $this->arguments = $arguments;
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function className() : string
    {
        return $this->className;
    }

    /**
     * @param Argument $argument
     */
    public function addArgument(Argument $argument) : void
    {
        $this->arguments->add($argument);
    }

    /**
     * @return bool
     */
    public function hasArguments() : bool
    {
        return (bool) count($this->arguments());
    }

    /**
     * @return Argument[]
     */
    public function arguments() : array
    {
        return $this->arguments->value();
    }
}