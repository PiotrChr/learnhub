<?php

namespace LearnHub\WebApp\WebAppBundle\Form\Type;

use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{

    private $container;
    

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'forms.username'))
            ->add('plainPassword',RepeatedType::class, array(
                'required' => true,
                'type' => PasswordType::class,
                'first_options' => array('label' => 'forms.password'),
                'second_options' => array('label' => 'forms.repeatPassword')
            ))
            ->add('captcha',CaptchaType::class, array('mapped' => false, 'label' => 'forms.captcha'))
            ->add('register',SubmitType::class, array(
                'label' => 'forms.register'
            ))
            ->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmit'))
        ;
    }
    
    public function getName() {
        return 'signup';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'=>'LearnHub\MainApp\MainAppBundle\Entity\User'
        ]);
    }

    public function onPreSubmit(FormEvent $event) {
        // ...
    }

    public function onPostSubmit(FormEvent $event) {
        $form = $event->getForm();

        /**
         * @var $user User
         */
        $user = $event->getData();
        
        $mailActivate = $this->container->get('web_app_bundle.registration.sendmail');
        $mailActivate->setUser($user);
        $mailActivate->send();
        
    }
}