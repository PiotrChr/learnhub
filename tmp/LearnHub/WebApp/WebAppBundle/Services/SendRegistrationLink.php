<?php
namespace LearnHub\WebApp\WebAppBundle\Services;

use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SendRegistrationLink {
    private $user;
    private $twig;
    private $container;
    private $activationToken;
    
    public function __construct(\Twig_Environment $twig, ContainerInterface $container) {
        $this->twig = $twig;
        $this->container = $container;
    }
    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function send() {
        $translator = $this->container->get('translator');
        $sender = $this->container->getParameter('mailer_registration_sender');
        $topic = $translator->trans($this->container->getParameter('mailer_registration_topic'));
        $username = $this->user->getUsername();
        $activationUrl = $this->container->get('web_app_bundle.registration.activationtoken')->createToken($this->user);

        $transporter = \Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
            ->setUsername('chrusciel.piotr.87@gmail.com')
            ->setPassword('pztnrv6y');

        $mailer = \Swift_Mailer::newInstance($transporter);

        $message = \Swift_Message::newInstance($topic)
            ->setFrom($sender)
            ->setTo($username)
            ->setBody($this->twig->render('WebAppBundle:Emails:registrationActivate.html.twig',[
                'activationUrl' => $activationUrl,
                'username' => $username
            ], 'text/html'));
        
        $mailer->send($message);
    }

}

