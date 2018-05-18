<?php
namespace BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Media;
use BackendBundle\Entity\ScreenShot;
use BackendBundle\Entity\Tag;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use BackendBundle\Entity\Link;

class SampleLinks extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $date = new \DateTime();
        $date->format('Y-m-d H:i:s');

        $urlInfo = $this->container->get('backend.hub.urlinfo');

        $link1 = new Link();
            $link1->setName('New link 1');
            $link1->setUrl('https://www.youtube.com/watch?v=5Uh6b3CDRaA');
            $link1->setCategory($this->getReference('category-anthropology'));
            $link1->addMedia($this->getReference('media-movie'));
            $link1->setAuthor($this->getReference('user-admin'));
            $link1->addTag($this->getReference('tag-sometag1'));
            $link1->addTag($this->getReference('tag-sometag2'));
            $link1->addTag($this->getReference('tag-sometag3'));
            $link1->setDatetime($date);

            /** @var $scr_link1 ScreenShot */
            $scr_link1 = $urlInfo->init('https://www.youtube.com/watch?v=5Uh6b3CDRaA')->getScreenShot();
            $scr_link1->setLink($link1);
        $manager->persist($link1);
        $manager->persist($scr_link1);

        $link2 = new Link();
            $link2->setName('Some title 2');
            $link2->setUrl('http://google.com');
            $link2->setCategory($this->getReference('category-toxicology'));
            $link2->addMedia($this->getReference('media-article'));
            $link2->setAuthor($this->getReference('user-admin'));
            $link2->addTag($this->getReference('tag-sometag1'));
            $link2->addTag($this->getReference('tag-sometag2'));
            $link2->addTag($this->getReference('tag-sometag3'));
            $link2->setDatetime($date);
            $scr_link2 = $urlInfo->init('http://google.com')->getScreenShot();
            $scr_link2->setLink($link2);
        $manager->persist($link2);
        $manager->persist($scr_link2);

        $link3 = new Link();
            $link3->setName('Litwo ojczyzno moja');
            $link3->setUrl('https://www.youtube.com/watch?v=5Uh6b3CDRaA');
            $link3->setCategory($this->getReference('category-medicine'));
            $link3->addMedia($this->getReference('media-movie'));
            $link3->setAuthor($this->getReference('user-admin'));
            $link3->addTag($this->getReference('tag-sometag1'));
            $link3->setDatetime($date);
            $scr_link3 = $urlInfo->init('https://www.youtube.com/watch?v=5Uh6b3CDRaA')->getScreenShot();
            $scr_link3->setLink($link3);
        $manager->persist($link3);
        $manager->persist($scr_link3);

        $link4 = new Link();
            $link4->setName('Jeszcze jeden tytul');
            $link4->setUrl('http://google.com');
            $link4->setCategory($this->getReference('category-cardiology'));
            $link4->setAuthor($this->getReference('user-admin'));
            $link4->addMedia($this->getReference('media-article'));
            $link4->addTag($this->getReference('tag-sometag1'));
            $link4->addTag($this->getReference('tag-sometag2'));
            $link4->setDatetime($date);
            $scr_link4 = $urlInfo->init('http://google.com')->getScreenShot();
            $scr_link4->setLink($link4);
        $manager->persist($link4);
        $manager->persist($scr_link4);

        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }
}