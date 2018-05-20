<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;
use App\Entity\Click;
use App\Exception\DoubleClickException;
use App\Exception\EntityNotFoundException;
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

    /**
     * @param ClickDto $clickDto
     *
     * @throws \App\Exception\DoubleClickException
     */
    public function handleClick(ClickDto $clickDto): void
    {
        try {
            $click = $this->clickRepository->getClickById($clickDto->getId()->toString());

            $click->incrementErrorCount();
            $this->clickRepository->updateClick($click);

            throw new DoubleClickException('Клик уже существует');
        } catch (EntityNotFoundException $e) {
            $click = Click::createFromDto($clickDto);
            $this->clickRepository->addClick($click);
        }
    }
}
