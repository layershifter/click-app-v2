<?php

declare(strict_types=1);

namespace Tests\Functional;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractFunctionalTest extends WebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $kernel = static::bootKernel();

        if ('test' !== $kernel->getEnvironment()) {
            throw new \LogicException('Should be executed in the test environment');
        }

        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $metadata = $em->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($em);
        $schemaTool->updateSchema($metadata);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $kernel = static::bootKernel();

        if ('test' !== $kernel->getEnvironment()) {
            throw new \LogicException('Should be executed in the test environment');
        }

        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $schemaTool = new SchemaTool($em);
        $schemaTool->dropDatabase();
    }
}
