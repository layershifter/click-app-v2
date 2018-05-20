<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\ClickDto;

interface ClickHandlerServiceInterface
{
    public function handleClick(ClickDto $clickDto): void;
}
