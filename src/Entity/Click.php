<?php

declare(strict_types=1);

namespace App\Entity;

use App\Dto\ClickDto;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="DoctrineClickRepository")
 * @ORM\Table(name="click")
 */
class Click
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", name="id", unique=true)
     *
     * @var UuidInterface
     */
    private $id;
    /**
     * @ORM\Column(type="integer", name="bad_domain", nullable=true)
     */
    private $badDomain;
    /**
     * @ORM\Column(type="integer", name="error")
     */
    private $errorCount;
    /**
     * @ORM\Column(type="string", length=15, name="ip")
     */
    private $ip;
    /**
     * @ORM\Column(type="string", length=255, name="param1")
     */
    private $param1;
    /**
     * @ORM\Column(type="string", length=255, name="param2")
     */
    private $param2;
    /**
     * @ORM\Column(type="string", length=255, name="ref")
     */
    private $referrer;
    /**
     * @ORM\Column(type="string", length=255, name="ua")
     */
    private $userAgent;

    public static function createFromDto(ClickDto $dto): Click
    {
        $click = new self();

        $click->id = $dto->getId();
        $click->errorCount = 0;
        $click->ip = $dto->getIp();
        $click->param1 = $dto->getParam1();
        $click->param2 = $dto->getParam2();
        $click->referrer = $dto->getReferrer();
        $click->userAgent = $dto->getUserAgent();

        return $click;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getBadDomain(): ?int
    {
        return $this->badDomain;
    }

    public function getErrorCount(): int
    {
        return $this->errorCount;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getParam1(): string
    {
        return $this->param1;
    }

    public function getParam2(): string
    {
        return $this->param2;
    }

    public function getReferrer(): string
    {
        return $this->referrer;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function incrementErrorCount(): void
    {
        ++$this->errorCount;
    }
}
