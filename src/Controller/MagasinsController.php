<?php

namespace App\Controller;

use App\Entity\Magasins;
use App\Form\MagasinsType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MagasinsController extends AbstractController
{
    /**
     * @Route("/magasin", name="magasins")
     */
    public function index(): Response
    {
        $repositoryMagasins = $this->getDoctrine()->getRepository('App:Magasins');
        $magasinsAll = $repositoryMagasins->findAll();

        return $this->render('app/magasins.html.twig', [
            'magasins' => $magasinsAll,
        ]);
    }

    /**
     * @Route("/magasin/creer/{id}", name="magasin_id")
     */
    public function magasinId($id, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $repositoryMagasins = $this->getDoctrine()->getRepository('App:Magasins');
        $magasins = $repositoryMagasins->find($id);

        $creermagasin = $this->createForm(MagasinsType::class, $magasins);
        $creermagasin->handleRequest($request);
        if($creermagasin->isSubmitted()) {
            if ($creermagasin->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($magasins);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', 'Magasin les données mises à jour.');
                return $this->redirectToRoute('magasin_id', ['id' => $magasins->getId()]);
            }
        }

        return $this->render('app/creermagasin.html.twig', [
            'form' => $creermagasin->createView(),
        ]);
    }

    /**
     * @Route("/magasin/creer", name="creermagasin")
     */
    public function creerMagasin(Request $request, MailerInterface $mailer, UserPasswordEncoderInterface $encoder){
        $magasins = new Magasins();
        $token = bin2hex(random_bytes(60));
        $creermagasin = $this->createForm(MagasinsType::class, $magasins);
        $creermagasin->handleRequest($request);
        if($creermagasin->isSubmitted()) {
            if ($creermagasin->isValid()) {
                $repositoryMagasins = $this->getDoctrine()->getRepository('App:Magasins');
                $is_magasins = $repositoryMagasins->findOneBy(['email' => $magasins->getEmail()]);
                if(!is_null($is_magasins)){
                    $request->getSession()->getFlashBag()->add('danger', 'Un magasin avec cet e-mail est déjà enregistré.');
                }
                else {
                    $em = $this->getDoctrine()->getManager();
                    $magasins->setPassword($encoder->encodePassword(new Magasins, $magasins->getPassword()));
                    $magasins->setStatut(0);
                    $magasins->setDateCreation(new \DateTime);
                    $magasins->setToken($token);
                    $em->persist($magasins);
                    $em->flush();

                    $email = (new TemplatedEmail())
                        ->from(new Address('DoNotReply@recobike.com', 'RECOBIKE'))
                        ->to($magasins->getEmail())
                        ->subject('Validez votre compte professionnel Recobike.com')
                        ->htmlTemplate('emails/magasins_new.html.twig')
                        ->context([
                            'token' => $token
                        ])
                    ;
                    $mailer->send($email);

                    $request->getSession()->getFlashBag()->add('success', 'Une fois que le magasin à valider son inscription
                 à l’aide du lien présent dans l’email, il peut alors se connecter avec son email et son mot de passe.');
                    return $this->redirectToRoute('magasin_id', ['id' => $magasins->getId()]);
                }
            }
        }

        return $this->render('app/creermagasin.html.twig', [
            'form' => $creermagasin->createView(),
        ]);
    }
}
