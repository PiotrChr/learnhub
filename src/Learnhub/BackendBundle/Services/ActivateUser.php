<?php
namespace LearnHub\BackendBundle\Services;

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
        $repository = $this->em->getRepository('BackendBundle:User');
        return ($repository->findOneBy(array('activationToken' => $this->token))) ? true : false;
    }

    public function activate() {
        $repository = $this->em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(array('activationToken' => $this->token));

        $user->setActivationToken(null);
        $user->setIsActive(true);

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

}