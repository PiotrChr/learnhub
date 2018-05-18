<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LearnHub\MainApp\MainAppBundle\Entity\Link;
use LearnHub\WebApp\WebAppBundle\Form\Type\AddSourceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HubController extends Controller
{


    public function indexAction() {
        return $this->render('WebAppBundle:Hub:default.html.twig');
    }

    public function newAction() {
        $em = $this->get('doctrine')->getManager();

        /*
         * Get last 100 added links, sorted by datetime, descending
         * */
        $newLinks = $em->getRepository('MainAppBundle:Link')->findBy([],['datetime' => 'DESC'],100);

        array_walk($newLinks,function(&$val, $key) {
            /**
             * @var $val Link
             * @var $screenShot PersistentCollection
             *
             */
            $screenShot = $val->getScreenShot();
            $screenShot->initialize();
        });

        return $this->render('WebAppBundle:Hub:new.html.twig', [
            'newLinks' => $newLinks
        ]);
    }

    /**
    * Details Action
     *
     * Passes link details to Hub/Details/default.html.twig
     * todo: $linkSlug not protected
     *
     * @param $linkSlug string
     * @return mixed
    **/
    public function detailsAction($linkSlug) {
        /**
         *@var $em EntityManager
         * */
        $em = $this->get('doctrine')->getManager();
        $link = $em->getRepository('MainAppBundle:Link')->findOneBy(['slug' => $linkSlug]);

        return $this->render('WebAppBundle:Hub/Details:default.html.twig',['link' => $link]);
    }

    public function categoriesAction(Request $request) {
        return $this->render('WebAppBundle:Hub/Categories:default.html.twig');
    }

    public function addSourceAction(Request $request) {

        $link = new Link();

        $form = $this->createForm(AddSourceType::class, $link, [
            'action' => $this->generateUrl('web_app_hub.addSource'),
            'translation_domain' => 'forms'
        ]);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $addLink = $this->get('web_app_bundle.hub.add_link');
            $addLink->add($form->getData());

            return $this->redirectToRoute('web_app_hub.addSource.thankYou');
        }

        return $this->render('WebAppBundle:Hub:addSource.html.twig',[
            'addSourceForm' => $form->createView(),
        ]);
    }

    public function thankYouAction() {
        return $this->render('WebAppBundle:Hub:addThankyou.html.twig');
    }
}
