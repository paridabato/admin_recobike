<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Transport\TransportInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class UtilisateursController extends AbstractController
{
    use ResetPasswordControllerTrait;
    private $resetPasswordHelper;

    public function __construct(ResetPasswordHelperInterface $resetPasswordHelper)
    {
        $this->resetPasswordHelper = $resetPasswordHelper;
    }

    /**
     * @Route("/utilisateur", name="utilisateurs")
     */
    public function proprietaires(Request $request){
        $repositoryUtilisateurs = $this->getDoctrine()->getRepository('App:Utilisateurs');
        $utilisateursAll = $repositoryUtilisateurs->findAll();

        return $this->render('app/utilisateurs.html.twig', array(
            'utilisateurs' => $utilisateursAll
        ));
    }

    /**
     * @Route("/utilisateur/creer", name="creer_utilisateur")
     * @Route("/utilisateur/edit/{id}", name="edit_utilisateur_id")
     */
    public function creerUtilisateur(Request $request, MailerInterface $mailer, UserPasswordEncoderInterface $encoder, $id = false){
        $repositoryUtilisateurs = $this->getDoctrine()->getRepository('App:Utilisateurs');
        $em = $this->getDoctrine()->getManager();
        $new = true;
        if($id){
            $utilisateurs = $repositoryUtilisateurs->find($id);
            $new = false;
        }
        else $utilisateurs = new Utilisateurs();

        $token = bin2hex(random_bytes(60));
        $creer_utilisateurs = $this->createForm(UtilisateursType::class, $utilisateurs);
        $creer_utilisateurs->handleRequest($request);
        if($creer_utilisateurs->isSubmitted()) {
            if ($creer_utilisateurs->isValid()) {
                if($new){
                    $is_utilisateurs = $repositoryUtilisateurs->findOneBy(['email' => $utilisateurs->getEmail()]);
                    if(!is_null($is_utilisateurs)){
                        $request->getSession()->getFlashBag()->add('danger', 'Un utilisateurs avec cet e-mail est déjà enregistré.');
                    }
                    else {
                        $utilisateurs->setDateCreation(new \DateTime);
                        $utilisateurs->setStatut(0);
                        $utilisateurs->setPassword(($encoder->encodePassword(new Utilisateurs, 'password')));
                        $utilisateurs->setToken($token);
                        $em->persist($utilisateurs);
                        $em->flush();

                        $email = (new TemplatedEmail())
                            ->from(new Address('DoNotReply@recobike.com', 'RECOBIKE'))
                            ->to($utilisateurs->getEmail())
                            ->subject('Validez votre compte administration Recobike.com')
                            ->htmlTemplate('emails/utilisateurs_new.html.twig')
                            ->context([
                                'token' => $token
                            ])
                        ;
                        $mailer->send($email);

                        $request->getSession()->getFlashBag()->add('success', 'Utilisateur créé!');
                    }
                }
                else {
                    $em->persist($utilisateurs);
                    $em->flush();
                    $request->getSession()->getFlashBag()->add('success', 'Utilisateur update!');
                }
            }
        }

        return $this->render('app/creer_utilisateur.html.twig', array(
            'form' => $creer_utilisateurs->createView(),
        ));
    }

    /**
     * @Route("/validation", name="validation")
     */
    public function validationUtilisateur(Request $request){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $SessID = $request->query->get('SessID');
        $repositoryUtilisateurs = $this->getDoctrine()->getRepository('App:Utilisateurs');
        $enregistrer_new = $repositoryUtilisateurs->findOneBy(array('token' => $SessID));

        if($enregistrer_new) {
            $enregistrer_new->setToken('');
            $enregistrer_new->setStatut(1);
            $em->persist($enregistrer_new);
            $em->flush();
            $session->getFlashBag()->add('success', 'Utilisateurs save !');
        }
        else $session->getFlashBag()->add('danger', 'Token invalid !');
        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/utilisateur/reinitializer/{id}", name="reinitializer_utilisateur_id")
     */
    public function reinitializerUtilisateur($id, MailerInterface $mailer, Request $request){
        $user = $this->getDoctrine()->getRepository(Utilisateurs::class)->find($id);
        $this->setCanCheckEmailInSession();
        if (!$user) {
            return $this->redirectToRoute('app_check_email');
        }
        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            return $this->redirectToRoute('app_check_email');
        }

        $email = (new TemplatedEmail())
            ->from(new Address('DoNotReply@recobike.com', 'RECOBIKE'))
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->htmlTemplate('reset_password/email.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ])
        ;
        $mailer->send($email);
        $request->getSession()->getFlashBag()->add('success', 'Utilisateurs password réinitialiser !');

        return $this->redirectToRoute('utilisateurs');
    }
}