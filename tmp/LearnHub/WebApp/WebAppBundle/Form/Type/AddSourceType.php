<?php

namespace LearnHub\WebApp\WebAppBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DomCrawler\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Collections\ArrayCollection;


/*
 * TODO: form wizard
 *
 * */

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddSourceType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'forms.sourceName'
            ])
            ->add('description', TextareaType::class, [
                'mapped' => true,

            ])
            ->add('category', TextType::class, [
                'label' => 'forms.chooseCategory'

            ])
            ->add('url', TextType::class, [
                'label' => 'forms.source'
            ])
            ->add('media',ChoiceType::class,[
                'choices' => $this->getMediaChoices(),
                'mapped' => true,
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                'data_class' => 'LearnHub\MainApp\MainAppBundle\Entity\Media',
                'choice_label' => function($media,$key,$index) {
                    return json_encode([
                        'id' => $media->getId(),
                        'media_type' => $media->getName(),
                        'icon_type' => $media->getIconType(),
                        'icon' => $media->getIcon()
                    ]);
                }
            ])
            ->add('tag',TextType::class, [
                'label' => 'forms.chooseTag'
            ])
            ->add('add',SubmitType::class, [
                'label' => 'forms.addSource'
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'))
            ->addEventListener(FormEvents::POST_SUBMIT, array($this, 'onPostSubmit'))
        ;

        
//        I really don't know why it works : (
        $builder
            ->get('category')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalCategory) {
                },
                function ($submittedCategory) {
                    return $submittedCategory;
                }
            ))
        ;
    }

    public function getName() {
        return 'addSource';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class'=>'LearnHub\MainApp\MainAppBundle\Entity\Link'
        ]);
    }

    private function getMediaChoices() {
        $media = $this->em->getRepository('MainAppBundle:Media')->findAll();
        return new ArrayCollection($media);

    }

    public function onPostSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

//        die(dump($form,$data));

    }

    public function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        foreach ($data['category'] as &$cat) {
            $cat = $this->em->getRepository('MainAppBundle:Category')->findOneBy(['id'=>$cat]);
        }

        //$data['media'] = [$this->em->getRepository('MainAppBundle:Media')->findOneBy(['id'=>$data['media']])];

        $event->setData($data);
    }
}