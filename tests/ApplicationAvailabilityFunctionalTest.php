<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        $statusCode = $client->getResponse()->getStatusCode();
        if(($statusCode >= 200 and $statusCode <= 299) OR $statusCode == 301)
            $this->assertTrue(true);
        else
            $this->assertTrue(false, 'Problemas en la URL ->'.$url.' Status:'.$statusCode);

    }

    public function urlProvider()
    {
        yield ['/'];
        yield ['/admin'];
        yield ['/welcome'];
        yield ['/number'];
    }
}