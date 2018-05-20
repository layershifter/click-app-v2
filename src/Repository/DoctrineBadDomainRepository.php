<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BadDomain;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

final class DoctrineBadDomainRepository extends ServiceEntityRepository implements BadDomainRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BadDomain::class);
    }

    public function addDomain(BadDomain $badDomain): void
    {
        $this->_em->persist($badDomain);
        $this->_em->flush($badDomain);
    }

    public function deleteDomain(BadDomain $badDomain): void
    {
        $this->_em->remove($badDomain);
        $this->_em->flush($badDomain);
    }

    /**
     * @param int $domainId
     *
     * @return BadDomain
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getDomainById(int $domainId): BadDomain
    {
        /* @var BadDomain|null $badDomain */
        $badDomain = $this->find($domainId);

        if (null === $badDomain) {
            throw new EntityNotFoundException('BadDomain не найден');
        }

        return $badDomain;
    }
}
