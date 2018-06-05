<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    /**
     * @Route("/", name="app_lucky_number")
     */
    public function number()
    {
        $number = mt_rand(0, 100);

        return $this->render('page/test.html.twig', ["nombre" => $number]);
    }
     /**
     * @Route("/SendMail", name="sendMail")
     */
    public function sendMail(\Swift_Mailer $mailer)
    {
         $message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo('recipient@example.com')
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'page/test.html.twig',
                array('nombre' => 12)
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;
    $mailer->send($message);
       return new Response(
            '<html><body>Lucky number: ok </body></html>'
        );
    }
}
