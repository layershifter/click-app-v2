<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;
use App\Exception\BadDomainClickException;
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
     * @throws \App\Exception\BadDomainClickException
     * @throws \App\Exception\DoubleClickException
     */
    public function handleClick(ClickDto $clickDto): void
    {
        try {
            $click = $this->clickService->getClickById($clickDto->getId()->toString());
            $click->incrementErrorCount();

            $this->clickService->updateClick($click);

            throw new DoubleClickException('Клик уже существует');
        } catch (EntityNotFoundException $e) {
            $click = $this->clickService->addClick($clickDto);
        }

        try {
            //$badDomain = $this->badDomainService->getDomainByName($clickDto->getReferrerDomain());
            $badDomain = $this->badDomainService->getDomainById(2);

            $click->assignBadDomain($badDomain->getName());
            $this->clickService->updateClick($click);

            throw new BadDomainClickException('У клик bad domain');
        } catch (EntityNotFoundException $e) {
        }
    }
}
