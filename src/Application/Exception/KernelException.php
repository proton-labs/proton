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

namespace Proton\Application\Exception;

final class KernelException extends Exception
{
    /**
     * @param string $extensionClass
     *
     * @throws KernelException
     *
     * @return KernelException
     */
    public static function missingExtension(string $extensionClass) : KernelException
    {
        throw new self(sprintf("Extension \"%s\" is missing, can't build service container.", $extensionClass));
    }

    /**
     * @throws KernelException
     *
     * @return KernelException
     */
    public static function notBuilt() : KernelException
    {
        throw new self("Kernel wasn't built yet, can't boot.");
    }
}
