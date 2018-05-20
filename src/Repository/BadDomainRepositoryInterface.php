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
}
