<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 16/11/2018
 * Time: 7:45 PM
 */

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\DealStatus;
use App\Form\DealType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
        $deals = $this->getDoctrine()->getRepository(Deal::class)->findAll();

        return $this->render('invoice/list.html.twig', [
            'username' => $this->getUser()->getUsername(),
            'deals' => $deals,
        ]);
    }

    /**
     * @Route("/new", name="invoice.new")
     */
    public function new(Request $request) : Response
    {
        $form = $this->createForm(DealType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var Deal $deal */
            $deal = $form->getData();

            $deal->setDealStatus($this->getDoctrine()->getRepository(DealStatus::class)->findOneBy(['id' => DealStatus::PENDING]));

            $em->persist($deal);
            $em->flush();

            return $this->redirectToRoute('invoice.list');
        }

        return $this->render('invoice/new.html.twig', [
            'username'  => $this->getUser()->getUsername(),
            'form'      => $form->createView(),
        ]);
    }
}