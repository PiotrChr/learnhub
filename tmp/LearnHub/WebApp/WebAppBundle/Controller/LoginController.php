<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use LearnHub\WebApp\WebAppBundle\Form\Type\LoginType;
use LearnHub\WebApp\WebAppBundle\Model\User as UserModel;

class LoginController extends Controller
{
    public function indexAction(Request $request) {
        $user = new User();
        $form = $this->createForm(LoginType::class, $user, [
            'action' => $this->generateUrl('web_app_signin.check'),
            'translation_domain' => 'forms'
        ]);

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('WebAppBundle:Login:login.html.twig',array(
            'loginForm' => $form->createView(),
            'signedOut' => $request->get('signedOut') ? true : false,
            'lastUsername' => $lastUsername,
            'error' => $error
        ));
    }

    public function checkAction() {
        
    }
}

