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

namespace Proton\Domain\Hydrator;

use GeneratedHydrator\Configuration;

final class HydratorFactory
{
    /**
     * @param array  $classes
     * @param string $path
     *
     * @throws \CodeGenerationUtils\Exception\InvalidGeneratedClassesDirectoryException
     */
    public function generate(array $classes, string $path) : void
    {
        foreach ($classes as $class) {
            $config = new Configuration($class);
            $config->setGeneratedClassesTargetDir($path);
            $config->createFactory()->getHydratorClass();
        }
    }
}
