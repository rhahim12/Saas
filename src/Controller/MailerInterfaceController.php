<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class MailerInterfaceController extends AbstractController
{
    #[Route('/mailer/interface', name: 'app_mailer_interface')]
    public function index(MailerInterface $mailer): Response
    {
        $file_resource = tmpFile();
        fwrite($file_resource, "Ceci est le contenu du fichier à attacher au mail !");
        
        $email = new Email();
        $email->from("website@cool.com")
            ->to("test.ossssssssssssslaf@gmail.com")
            ->subject("Ceci est un mail Test sujet")
            ->attach($file_resource, "nom_du_fichier.txt")
            ->text("Ceci est un mail Test texte");

        $mailer->send($email);

        return $this->redirectToRoute('app_home');


        // return $this->render('mailer_interface/index.html.twig', [
        //     'controller_name' => 'MailerInterfaceController',
        // ]);
    }
}
