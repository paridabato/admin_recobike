<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Grossistes;
use App\Entity\Magasins;
use App\Form\GrossistesType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_grossistes') or is_granted('ROLE_superadmin')")
 */
class GrossistesController extends AbstractController
{

    /**
     * @Route("/grossiste", name="grossistes")
     */
    public function grossistes(Request $request){
        $repositoryGrossistes = $this->getDoctrine()->getRepository('App:Grossistes');
        $grossistesAll = $repositoryGrossistes->findAll();

        return $this->render('app/grossistes.html.twig', array(
            'grossistes' => $grossistesAll
        ));
    }

    /**
     * @Route("/grossiste/creer", name="creergrossistes")
     * @Route("/grossiste/edit/{id}", name="editgrossistes_id")
     */
    public function creerGrossistes(Request $request, $id = false): Response
    {
        if($id){
            $repositoryGrossistes = $this->getDoctrine()->getRepository('App:Grossistes');
            $grossiste = $repositoryGrossistes->find($id);
        }
        else $grossiste = new Grossistes();

        $creergrossistes = $this->createForm(GrossistesType::class, $grossiste);
        $creergrossistes->handleRequest($request);
        if($creergrossistes->isSubmitted()) {
            if ($creergrossistes->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($grossiste);
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Grossiste les données mises à jour.');
            }
        }

        return $this->render('app/creergrossiste.html.twig', [
            'form' => $creergrossistes->createView(),
        ]);
    }
}