<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\BadDomainDto;
use Symfony\Component\HttpFoundation\Request;

final class BadDomainDtoFactory implements BadDomainDtoFactoryInterface
{
    public function createFromRequest(Request $request): BadDomainDto
    {
        return new BadDomainDto([
            'id' => $request->get('id'),
            'name' => $request->get('name'),
        ]);
    }
}
