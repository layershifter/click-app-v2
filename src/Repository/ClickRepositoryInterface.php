<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Click;

interface ClickRepositoryInterface
{
    public function addClick(Click $click): void;

    /**
     * @return Click[]
     */
    public function findAll();

    /**
     * @param string $clickId
     *
     * @return Click
     *
     * @throws \App\Exception\EntityNotFoundException
     */
    public function getClickById(string $clickId): Click;

    public function updateClick(Click $click): void;
}
