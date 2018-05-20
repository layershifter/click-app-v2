<?php

namespace App\Dto;

use App\Exception\DtoCreationException;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\ExceptionInterface as ResolverException;

class ClickDto
{
    /**
     * @var UuidInterface
     */
    private $id;
    /**
     * @var string
     */
    private $ip;
    /**
     * @var string
     */
    private $param1;
    /**
     * @var string
     */
    private $param2;
    /**
     * @var string
     */
    private $referrer;
    /**
     * @var string
     */
    private $userAgent;

    /**
     * @param UuidInterface $id
     * @param array $options
     *
     * @throws \App\Exception\DtoCreationException
     */
    public function __construct(UuidInterface $id, array $options)
    {
        try {
            $resolver = $this->configureResolver();
            $params = $resolver->resolve($options);
        } catch (ResolverException $e) {
            throw new DtoCreationException($e->getMessage(), 0, $e);
        }

        $this->id = $id;
        $this->ip = $params['ip'];
        $this->param1 = $params['param1'];
        $this->param2 = $params['param2'];
        $this->referrer = $params['referrer'];
        $this->userAgent = $params['userAgent'];
    }

    public function getId(): UuidInterface
    {
        return $this->id;
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

    private function configureResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();

        $resolver->setRequired(['ip', 'param1', 'param2', 'referrer', 'userAgent']);

        $resolver->setAllowedTypes('ip', 'string');
        $resolver->setAllowedTypes('param1', 'string');
        $resolver->setAllowedTypes('param2', 'string');
        $resolver->setAllowedTypes('referrer', 'string');
        $resolver->setAllowedTypes('userAgent', 'string');

        return $resolver;
    }
}
