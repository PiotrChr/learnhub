<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LogoutController extends Controller
{
    public function indexAction(Request $request) {
        $session = $request->getSession();
        $session->clear();
        
        return $this->redirectToRoute('web_app_signin',array(
            'signedOut' => true
        ));
    }
}
