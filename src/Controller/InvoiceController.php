<?php
/**
 * Created by PhpStorm.
 * User: CMEJIA
 * Date: 16/11/2018
 * Time: 7:45 PM
 */

namespace App\Controller;

use App\Entity\Deal;
use App\Entity\DealInvoice;
use App\Entity\DealStatus;
use App\Form\DealType;
use App\Form\FilterListType;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
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
    public function list(Request $request, $page) : Response
    {
        $data['keyword'] = (null !== $request->request->get('keyword')) ? $request->request->get('keyword') : null;
        $data['distributor'] = (null !== $request->request->get('distributor')) ? $request->request->get('distributor') : null;

        $deals = $this->getDoctrine()->getRepository(Deal::class)->findUsedFilters($data);
        $form = $this->createForm(FilterListType::class);

        return $this->render('invoice/list.html.twig', [
            'username' => $this->getUser()->getUsername(),
            'deals' => $deals,
            'form' => $form->createView()
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

    /**
     * @Route("/edit/{id}", name="invoice.edit", options={"expose"=true},)
     */
    public function editAction(Request $request, Deal $id) : Response
    {
        $form = $this->createForm(DealType::class, $id);

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

    /**
     * @Route("/delete/{id}", name="invoice.delete", options={"expose"=true},)
     */
    public function deleteAction(Request $request, Deal $id) : Response
    {
        $em = $this->getDoctrine()->getManager();

        $dealInvoice = $this->getDoctrine()->getRepository(DealInvoice::class)->findOneBy(['id' => $id->getDealInvoice()]);

        $em->remove($id);
        $em->remove($dealInvoice);
        $em->flush();

        return $this->redirectToRoute('invoice.list');
    }
}