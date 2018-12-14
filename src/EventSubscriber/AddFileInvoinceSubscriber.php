<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 13/12/2018
 * Time: 9:56 AM
 */

namespace App\EventSubscriber;


use Composer\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddFileInvoinceSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData'
        ];
    }

    public function onPreSetData(FormEvent $event)
    {
        dump($event->getData());die;
    }
}