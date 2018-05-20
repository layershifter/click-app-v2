<?php

namespace App\Service;

use App\Dto\ClickDto;
use App\Entity\Click;
use App\Exception\DoubleClickException;
use App\Exception\EntityNotFoundException;

final class ClickHandlerService implements ClickHandlerServiceInterface
{
    /**
     * @var BadDomainServiceInterface
     */
    private $badDomainService;
    /**
     * @var ClickServiceInterface
     */
    private $clickService;

    public function __construct(BadDomainServiceInterface $badDomainService, ClickServiceInterface $clickService)
    {
        $this->badDomainService = $badDomainService;
        $this->clickService = $clickService;
    }

    /**
     * @param ClickDto $clickDto
     *
     * @throws \App\Exception\DoubleClickException
     */
    public function handleClick(ClickDto $clickDto): void
    {
        try {
            $badDomain = $this->badDomainService->getDomainByName($clickDto->getReferrerDomain());
        } catch (EntityNotFoundException $e) {
            $badDomain = null;
        }

        try {
            $click = $this->clickService->getClickById($clickDto->getId()->toString());
            $click->incrementErrorCount();

            $this->clickService->updateClick($click);

            throw new DoubleClickException('Клик уже существует');
        } catch (EntityNotFoundException $e) {
            $this->clickService->addClick($clickDto);
        }
    }
}