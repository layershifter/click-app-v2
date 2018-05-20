<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\BadDomainDto;
use Symfony\Component\HttpFoundation\Request;

interface BadDomainDtoFactoryInterface
{
    public function createFromRequest(Request $request): BadDomainDto;
}
