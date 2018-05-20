<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\BadDomainDto;
use App\Entity\BadDomain;

interface BadDomainServiceInterface
{
    public function addDomain(BadDomainDto $badDomainDto);

    public function deleteDomain(BadDomain $badDomain);

    public function getDomainById(int $domainId): BadDomain;

    /**
     * @return BadDomain[]
     */
    public function findAll(): array;
}
