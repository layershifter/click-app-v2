<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ClickDto;
use Symfony\Component\HttpFoundation\Request;

interface ClickDtoFactoryInterface
{
    /**
     * @param Request $request
     *
     * @return ClickDto
     *
     * @throws \App\Exception\DtoCreationException
     */
    public function createFromRequest(Request $request): ClickDto;
}
