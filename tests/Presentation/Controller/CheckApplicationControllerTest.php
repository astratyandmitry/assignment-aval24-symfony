<?php

namespace App\Tests\Presentation\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CheckApplicationControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('POST', '/loans/application');

        self::assertResponseIsSuccessful();
    }
}
