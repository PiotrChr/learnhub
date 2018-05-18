<?php
namespace BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Media;
use BackendBundle\Entity\Tag;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class Tags extends AbstractFixture implements OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $tags = [
            'sometag1',
            'sometag2',
            'sometag3'
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->setName($tag);
            $manager->persist($newTag);

            $this->addReference('tag-'.$newTag->getName(),$newTag);
        }

        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }
}