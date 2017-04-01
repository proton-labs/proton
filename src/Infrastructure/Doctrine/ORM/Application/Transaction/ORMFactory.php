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
use Proton\Application\Transaction\Factory;
use Proton\Application\Transaction\Transaction;

final class ORMFactory implements Factory
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ORMFactory constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Transaction
     */
    public function open() : Transaction
    {
        $this->entityManager->beginTransaction();

        return new ORMTransaction($this->entityManager);
    }
}
