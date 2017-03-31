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

use Proton\Application\Service\Service;

final class ArgumentService implements Service
{
    /**
     * @var string
     */
    private $id;

    /**
     * ArgumentService constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function value() : string
    {
        return $this->id;
    }
}
