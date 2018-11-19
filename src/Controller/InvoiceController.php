<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 16/11/2018
 * Time: 7:45 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InvoiceController
 * @package App\Controller
 * @Route("/invoice")
 */
class InvoiceController extends Controller
{
    /**
     * @Route("/list/{page<\d+>?1}", name="invoice.list")
     */
    public function list($page) : Response
    {
        return $this->render('invoice/list.html.twig', [ 'username' => $this->getUser()->getUsername() ]);
    }

    /**
     * @Route("/new", name="invoice.new")
     */
    public function new() : Response
    {
        return $this->render('invoice/new.html.twig', [ 'username' => $this->getUser()->getUsername() ]);
    }
}