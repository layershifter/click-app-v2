<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\BadDomainDto;
use App\Entity\BadDomain;
use App\Repository\BadDomainRepositoryInterface;

final class BadDomainService implements BadDomainServiceInterface
{
    /**
     * @var BadDomainRepositoryInterface
     */
    private $domainRepository;

    public function __construct(BadDomainRepositoryInterface $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    public function addDomain(BadDomainDto $badDomainDto): void
    {
        $badDomain = BadDomain::createFromDto($badDomainDto);

        $this->domainRepository->addDomain($badDomain);
    }

    public function deleteDomain(BadDomain $badDomain): void
    {
        $this->domainRepository->deleteDomain($badDomain);
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
        return $this->domainRepository->getDomainById($domainId);
    }

    /**
     * @param string $domainName
     *
     * @return BadDomain
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getDomainByName(string $domainName): BadDomain
    {
        return $this->domainRepository->getDomainByName($domainName);
    }

    /**
     * @return BadDomain[]
     */
    public function findAll(): array
    {
        return $this->domainRepository->findAll();
    }
}
