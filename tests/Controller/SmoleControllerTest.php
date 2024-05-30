<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmoleControllerTest extends WebTestCase
{
    /**
     * @dataprovider provideUrls
     */
    public function testPublicUrlIsOk(string $url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }

    public function provideUrls(): iterable
    {
        yield ['/'];
        yield ['/contact'];
        yield ['/book'];
    }
}
