<?php

namespace App\Tests\Controller;


use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WelcomeControllerTest extends WebTestCase
{


    public function testIndex(){

        $event = new Event();

        $event->setName('test');
        $event->setPrice(123);
        $event->setDescription('test description');
        $event->setLocation('test location');

        /*$eventRepository = $this->createMock(EventRepository::class);
        $eventRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($event);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($eventRepository);*/


        $this->assertEquals(123, $event->getPrice());
    }

    public function testList(){
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
        $client->insulate();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Jeenson")')->count()
        );
    }
}