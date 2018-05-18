<?php

namespace LearnHub\WebApp\WebAppBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class LoginType extends AbstractType
{
    private $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class, [
                'label' => 'forms.username'
            ])
            ->add('_password',PasswordType::class, [
                'label' => 'forms.password'
            ])
            ->add('_remember',CheckboxType::class,[
                'label' => 'forms.loginRemember',
                'mapped' => false,
                'required' => false
            ])
            ->add('login',SubmitType::class, [
                'label' => 'forms.login'
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmit'))
        ;

    }

    public function getName() {
        return 'signin';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'=>'LearnHub\MainApp\MainAppBundle\Entity\User'
        ]);
    }

    public function onPostSubmit(FormEvent $event) {
        
    }
}