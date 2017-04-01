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

namespace Proton\Infrastructure\Tactician;

use League\Tactician\CommandBus as TacticianCommandBus;
use Proton\Application\Command\Command;

final class CommandBus implements \Proton\Application\CommandBus
{
    /**
     * @var TacticianCommandBus
     */
    private $commandBus;

    /**
     * CommandBus constructor.
     *
     * @param TacticianCommandBus $commandBus
     */
    public function __construct(TacticianCommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command) : void
    {
        $this->commandBus->handle($command);
    }
}
