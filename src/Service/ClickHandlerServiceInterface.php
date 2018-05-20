<?php

namespace App\Service;


use App\Dto\ClickDto;
use App\Entity\Click;

interface ClickHandlerServiceInterface
{
    public function handleClick(ClickDto $clickDto): void;
}
