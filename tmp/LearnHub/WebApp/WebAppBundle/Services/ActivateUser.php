<?php
namespace LearnHub\WebApp\WebAppBundle\Services;

use Doctrine\ORM\EntityManager;

class ActivateUser {
    
    private $em;
    private $token;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function check() {
        $repository = $this->em->getRepository('MainAppBundle:User');
        return ($repository->findOneBy(array('activationToken' => $this->token))) ? true : false;
    }

    public function activate() {
        $repository = $this->em->getRepository('MainAppBundle:User');
        $user = $repository->findOneBy(array('activationToken' => $this->token));

        $user->setActivationToken(null);
        $user->setIsActive(true);

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

}