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

namespace Proton\Infrastructure\Doctrine\ORM\Application\Transaction;

use Doctrine\ORM\EntityManager;
use Proton\Application\Transaction\Transaction;

final class ORMTransaction implements Transaction
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ORMTransaction constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function commit() : void
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function rollback() : void
    {
        $this->entityManager->rollback();
    }
}
