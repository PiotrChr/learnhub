<?php

namespace LearnHub\MainApp\MainAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainAppBundle:Default:index.html.twig');
    }
}
