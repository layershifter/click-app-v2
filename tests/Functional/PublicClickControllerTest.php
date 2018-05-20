<?php

namespace Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PublicClickControllerTest extends AbstractFunctionalTest
{
    public function testFirstClick(): void
    {
        $client = static::createClient();
        $client->request('GET', sprintf('/click/?param1=foo&param2=bar'));

        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertContains('/success', $client->getResponse()->headers->get('Location'));
    }

    public function testDoubleClick(): void
    {
        $firstClient = static::createClient();
        $firstClient->request('GET', sprintf('/click/?param1=foo&param2=bar'));

        $secondClient = static::createClient();
        $secondClient->request('GET', sprintf('/click/?param1=foo&param2=bar'));

        $this->assertTrue($firstClient->getResponse()->isRedirect());
        $this->assertTrue($secondClient->getResponse()->isRedirect());
        $this->assertContains('/error', $secondClient->getResponse()->headers->get('Location'));
    }

    public function testParam1Click(): void
    {
        $firstClient = static::createClient();
        $firstClient->request('GET', sprintf('/click/?param1=foo1&param2=bar'));

        $secondClient = static::createClient();
        $secondClient->request('GET', sprintf('/click/?param1=foo2&param2=bar'));

        $this->assertTrue($firstClient->getResponse()->isRedirect());
        $this->assertContains('/success', $firstClient->getResponse()->headers->get('Location'));

        $this->assertTrue($secondClient->getResponse()->isRedirect());
        $this->assertContains('/success', $secondClient->getResponse()->headers->get('Location'));
    }

    public function testParam2Click(): void
    {
        $firstClient = static::createClient();
        $firstClient->request('GET', sprintf('/click/?param1=foo&param2=bar1'));

        $secondClient = static::createClient();
        $secondClient->request('GET', sprintf('/click/?param1=foo&param2=bar2'));

        $this->assertTrue($firstClient->getResponse()->isRedirect());
        $this->assertContains('/success', $firstClient->getResponse()->headers->get('Location'));

        $this->assertTrue($secondClient->getResponse()->isRedirect());
        $this->assertContains('/error', $secondClient->getResponse()->headers->get('Location'));
    }
}
