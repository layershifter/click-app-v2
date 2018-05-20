<?php

declare(strict_types=1);

namespace Tests\Functional;

use App\Repository\ClickRepositoryInterface;
use App\Service\ClickService;
use App\Service\ClickServiceInterface;

final class ClickServiceTest extends AbstractFunctionalTest
{
    public function testFindAll(): void
    {
        $repositoryMock = $this->createMock(ClickRepositoryInterface::class);
        $repositoryMock->expects($this->once())->method('findAll')->willReturn([]);

        $clickService = new ClickService($repositoryMock);
        $clickService->findAll();
    }

    public function testImpliments(): void
    {
        $repositoryMock = $this->createMock(ClickRepositoryInterface::class);

        $this->assertInstanceOf(ClickServiceInterface::class, new ClickService($repositoryMock));
    }
}
