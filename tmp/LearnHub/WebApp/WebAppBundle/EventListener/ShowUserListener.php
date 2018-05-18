<?php
namespace LearnHub\WebApp\WebAppBundle\EventListener;

use Avanzu\AdminThemeBundle\Event\ShowUserEvent;
use LearnHub\WebApp\WebAppBundle\Model\UserModel as AvanzuModel;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;


class ShowUserListener {



    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function onShowUser(ShowUserEvent $event) {
        $user = $this->getUser();
        $event->setUser($user);
    }

    protected function getUser() {
        $securityContext = $this->container->get('security.authorization_checker');
        $username = $this->container->get('security.token_storage')->getToken()->getUsername();

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') || $securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {

            $avanzuUser = new AvanzuModel();
            $avanzuUser->setUsername($username);
            $avanzuUser->setName($username);

            return $avanzuUser;
        } 
        return new AvanzuModel();
    }

}