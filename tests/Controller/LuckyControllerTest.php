<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTest extends WebTestCase
{
    public function testNumber()
    {
        $client = static::createClient();

        $client->enableProfiler();

        $crawler = $client->request('GET', '/number');

        if($profile = $client->getProfile()){
            // check the number of requests
            $this->assertLessThan(
                1,
                $profile->getCollector('db')->getQueryCount()
            );

            // check the time spent in the framework
            $this->assertLessThan(
                500,
                $profile->getCollector('time')->getDuration()
            );

            $this->assertLessThan(
                30,
                $profile->getCollector('db')->getQueryCount(),
                sprintf(
                    'Checks that query count is less than 30 (token %s)',
                    $profile->getToken()
                )
            );
        }
    }
}