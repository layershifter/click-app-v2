<?php

namespace App\Factory;

use Ramsey\Uuid\UuidInterface;

interface ClickIdFactoryInterface
{
    public function createId(string $ip, string $param1, string $referrer, string $userAgent): UuidInterface;
}
