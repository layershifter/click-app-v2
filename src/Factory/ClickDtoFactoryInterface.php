<?php
/**
 * Created by PhpStorm.
 * User: layershifter
 * Date: 20.05.18
 * Time: 9:45
 */

namespace App\Factory;


use App\Dto\ClickDto;
use Symfony\Component\HttpFoundation\Request;

interface ClickDtoFactoryInterface
{
    /**
     * @param Request $request
     * @return ClickDto
     * @throws \App\Exception\DtoCreationException
     */
    public function createFromRequest(Request $request): ClickDto;
}