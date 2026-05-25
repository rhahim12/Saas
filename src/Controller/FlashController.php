<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use Composer\XdebugHandler\Status;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlashController extends AbstractController
{
    #[Route('/flash', name: 'app_flash')]
    public function index(InvoiceRepository $invoiceRepository): Response
    {


        return $this->render('flash/index.html.twig', [
            'controller_name' => 'FlashController',
            'invoices' => $invoiceRepository->findBy([
                'status' => 'brouillon'
            ]),
             'one' => $invoiceRepository->findOneBy([
                'id' => '5'
            ])
        ]);
    }
}
