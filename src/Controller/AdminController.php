<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /** @var array The full configuration of the entire backend */
    protected $config;
    /** @var array The full configuration of the current entity */
    protected $entity;
    /** @var Request The instance of the current Symfony request */
    protected $request;
    /** @var EntityManager The Doctrine entity manager for the current entity */
    protected $em;

    // override this method to initialize your custom properties
    protected function initialize(Request $request)
    {
        return parent::initialize($request); // TODO: Change the autogenerated stub
    }


    /** @Route("/", name="easyadmin") */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request); // TODO: Change the autogenerated stub
    }
}
