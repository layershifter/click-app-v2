<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\BadDomain;

interface BadDomainRepositoryInterface
{
    public function addDomain(BadDomain $badDomain): void;

    public function deleteDomain(BadDomain $badDomain): void;

    /**
     * @return BadDomain[]
     */
    public function findAll();

    public function getDomainById(int $domainId): BadDomain;
}
