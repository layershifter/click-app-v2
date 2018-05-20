<?php

declare(strict_types=1);

namespace App\Entity;

use App\Dto\BadDomainDto;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="DoctrineBadDomainRepository")
 * @ORM\Table(name="bad_domains")
 */
class BadDomain
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public static function createFromDto(BadDomainDto $badDomainDto): BadDomain
    {
        $domain = new self();
        $domain->name = $badDomainDto->getName();

        return $domain;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
