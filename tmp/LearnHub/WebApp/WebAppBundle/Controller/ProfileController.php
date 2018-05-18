<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function indexAction(Request $request) {

        /**
         * @var $user User
        */
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('WebAppBundle:Profile:profile.html.twig',array(
            'user' => $user
        ));
    }
}
