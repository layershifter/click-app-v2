<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;
use App\Entity\Click;

interface ClickServiceInterface
{
    /**
     * @return Click[]
     */
    public function findAll(): array;

    public function getClickById(string $clickId): Click;

    /**
     * @param ClickDto $clickDto
     *
     * @throws \App\Exception\DoubleClickException
     */
    public function handleClick(ClickDto $clickDto): void;
}
