<?php
namespace LearnHub\WebApp\WebAppBundle\Services;

use Doctrine\ORM\EntityManager;
use LearnHub\MainApp\MainAppBundle\Entity\Link;
use LearnHub\WebApp\WebAppBundle\Services\UrlInfo\UrlInfo;

class AddLink {

    private $em;
    
    public function __construct(EntityManager $em, UrlInfo $googleApi)
    {
        $this->em = $em;
        $this->ssga = $googleApi;
    }

    public function add(Link $link) {
        $link->setDatetime(new \DateTime('now'));
        $this->em->persist($link);
        $this->em->flush();


        $id = $link->getId();
        $i18n_title = 'topic.'.$id;
        $link->setI18nTitle($i18n_title);
        $this->em->persist($link);
        $this->em->flush();

//        $pageScreenshot = $this->ssga->fetch($link->getUrl());
//        $screenShot = new ScreenShot();
//        $screenShot->create($pageScreenshot);
//        $screenShot->setLink($link);
//        $this->em->persist($screenShot);
        $this->em->flush();
    }
}