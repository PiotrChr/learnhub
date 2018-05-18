<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use LearnHub\MainApp\MainAppBundle\Entity\AccessLevel;
use LearnHub\WebApp\WebAppBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use LearnHub\MainApp\MainAppBundle\Entity\User;


class RegistrationController extends Controller
{
    public function indexAction(Request $request) {

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user, array('translation_domain' => 'forms'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activationToken = $this->get('web_app_bundle.registration.activationtoken');

            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // set activation token
            $user->setActivationToken($activationToken->createToken($user));

            // defaults
            $user->setRole('ROLE_USER');
            $user->setIsActive(false);
            
            if ($this->registerUser($user)) $this->redirectToRoute('web_app_hub.registration.thankyou');
        }

        return $this->render('WebAppBundle:Registration:registration.html.twig',array(
            'errors' => $this->get('get_form_errors')->getErrors($form),
            'registrationForm' => $form->createView()

        ));
    }
    
    public function registerUser(User $user) {
        $em = $this->getDoctrine()->getManager();
        $access_level = $em->getRepository('MainAppBundle:AccessLevel')->findOneBy(array('level'=>1));

        $user->setAccessLevel($access_level);

        try {
            $em->persist($user);
            $em->flush();
        } catch (Exception $e) {
            die(dump($e));
        }

        return true;
    }
    
    public function thankYouAction() {
        return $this->render('WebAppBundle:Registration:thankYou.html.twig');
    }
    
    public function activateAction($token) {

        if (empty($token)) return $this->render('WebAppBundle:Registration:notFoundOrActive.html.twig');

        $activator = $this->get('web_app_bundle.activate_user');
        $activator->setToken($token);
        
        if ($activator->check()) {
            $activator->activate();
            return $this->render('WebAppBundle:Registration:activated.html.twig');
        } else {
            return $this->render('WebAppBundle:Registration:notFoundOrActive.html.twig');;
        }
    }

}
