<?php
namespace App\Service;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Security\Core\Security;

class ActivityListener
{
    private $em;
    private $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function onCoreController(ControllerEvent $event)
    {
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }

        if ($this->security->getToken()) {
            $user = $this->security->getToken()->getUser();
            if ( ($user instanceof Utilisateurs) ) {
                $user->setDernierAcces(new \DateTime());
                $this->em->flush($user);
            }
        }
    }
}