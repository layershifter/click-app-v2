<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Click;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class DoctrineClickRepository extends ServiceEntityRepository implements ClickRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Click::class);
    }

    public function addClick(Click $click): void
    {
        $this->_em->persist($click);
        $this->_em->flush($click);
    }

    /**
     * @param string $clickId
     *
     * @return Click
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getClickById(string $clickId): Click
    {
        /* @var Click|null $click */
        $click = $this->find($clickId);

        if (null === $click) {
            throw new EntityNotFoundException('Click не найден');
        }

        return $click;
    }

    public function updateClick(Click $click): void
    {
        $this->_em->persist($click);
        $this->_em->flush($click);
    }
}
