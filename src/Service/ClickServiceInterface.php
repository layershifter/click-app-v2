<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;
use App\Entity\Click;

interface ClickServiceInterface
{
    public function addClick(ClickDto $clickDto): Click;

    /**
     * @return Click[]
     */
    public function findAll(): array;

    public function getClickById(string $clickId): Click;

    /**
     * @param Click $click
     */
    public function updateClick(Click $click): void;
}
