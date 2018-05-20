<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;
use App\Entity\Click;
use App\Repository\ClickRepositoryInterface;

final class ClickService implements ClickServiceInterface
{
    /**
     * @var ClickRepositoryInterface
     */
    private $clickRepository;

    public function __construct(ClickRepositoryInterface $clickRepository)
    {
        $this->clickRepository = $clickRepository;
    }

    public function addClick(ClickDto $clickDto): Click
    {
        $click = Click::createFromDto($clickDto);
        $this->clickRepository->addClick($click);

        return $click;
    }

    /**
     * @return Click[]
     */
    public function findAll(): array
    {
        return $this->clickRepository->findAll();
    }

    public function getClickById(string $clickId): Click
    {
        return $this->clickRepository->getClickById($clickId);
    }

    public function updateClick(Click $click): void
    {
        $this->clickRepository->updateClick($click);
    }
}
