<?php
namespace LearnHub\WebApp\WebAppBundle\Services;

use Doctrine\ORM\EntityManager;
use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActivationToken {

    private $em;
    private $container;

    public function __construct(EntityManager $em, ContainerInterface $container) {
        $this->container = $container;
        $this->em = $em;
    }

    /**
     * @param User $user
     * @return string
    */
    public function createToken(User $user) {
        $token_secret = $this->container->getParameter('mailer_registration_token_secret');
        return md5($user->getUsername().$token_secret);
    }

    /**
     * @return User
     * */
    public function checkToken() {
        
    }
}