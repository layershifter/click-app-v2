<?php

declare(strict_types=1);

namespace App\Dto;

use App\Exception\DtoCreationException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as ResolverException;

class BadDomainDto
{
    /**
     * @var int|null
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    /**
     * @param array $options
     *
     * @throws \App\Exception\DtoCreationException
     */
    public function __construct(array $options)
    {
        try {
            $resolver = $this->configureResolver();
            $params = $resolver->resolve($options);
        } catch (ResolverException $e) {
            throw new DtoCreationException($e->getMessage(), 0, $e);
        }

        $this->id = null === $params['id'] ? null : (int) $params['id'];
        $this->name = $params['name'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function configureResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        $resolver->setDefault('id', null);
        $resolver->setRequired(['name']);

        $resolver->setAllowedTypes('id', ['null', 'int', 'string']);
        $resolver->setAllowedTypes('name', 'string');

        return $resolver;
    }
}
