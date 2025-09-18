<?php

namespace App\Tests\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CreateClientControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('POST', '/clients');

        self::assertResponseIsSuccessful();
    }
}
