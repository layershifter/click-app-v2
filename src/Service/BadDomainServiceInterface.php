<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\BadDomainDto;
use App\Entity\BadDomain;

interface BadDomainServiceInterface
{
    public function addDomain(BadDomainDto $badDomainDto);

    public function deleteDomain(BadDomain $badDomain);

    /**
     * @param int $domainId
     *
     * @return BadDomain
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getDomainById(int $domainId): BadDomain;

    /**
     * @param string $domainName
     *
     * @return BadDomain
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getDomainByName(string $domainName): BadDomain;

    /**
     * @return BadDomain[]
     */
    public function findAll(): array;
}
