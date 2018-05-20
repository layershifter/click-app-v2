<?php

declare(strict_types=1);

namespace App\Factory;

use App\Dto\ClickDto;
use Symfony\Component\HttpFoundation\Request;

final class ClickDtoFactory implements ClickDtoFactoryInterface
{
    /**
     * @var ClickIdFactoryInterface
     */
    private $clickIdFactory;

    public function __construct(ClickIdFactoryInterface $clickIdFactory)
    {
        $this->clickIdFactory = $clickIdFactory;
    }

    /**
     * @param Request $request
     *
     * @return ClickDto
     *
     * @throws \App\Exception\DtoCreationException
     */
    public function createFromRequest(Request $request): ClickDto
    {
        $ip = $request->getClientIp();
        $param1 = $request->query->get('param1');
        $param2 = $request->query->get('param2');
        $referrer = $request->headers->get('Referer', 'NA');
        $userAgent = $request->headers->get('User-Agent');

        $clickId = $this->clickIdFactory->createId($ip, $param1, $referrer, $userAgent);

        return new ClickDto($clickId, compact('ip', 'param1', 'param2', 'referrer', 'userAgent'));
    }
}
