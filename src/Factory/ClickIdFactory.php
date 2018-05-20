<?php

namespace App\Factory;

use Ramsey\Uuid\UuidFactoryInterface;
use Ramsey\Uuid\UuidInterface;

final class ClickIdFactory implements ClickIdFactoryInterface
{
    /**
     * @var UuidFactoryInterface
     */
    private $uuidFactory;
    /**
     * @var string
     */
    private $clickNamespace;

    public function __construct(UuidFactoryInterface $uuidFactory, string $clickNamespace)
    {
        $this->clickNamespace = $clickNamespace;
        $this->uuidFactory = $uuidFactory;
    }

    public function createId(string $ip, string $param1, string $referrer, string $userAgent): UuidInterface
    {
        return $this->uuidFactory->uuid5(
            $this->clickNamespace,
            $ip . $param1 . $referrer . $userAgent
        );
    }
}
