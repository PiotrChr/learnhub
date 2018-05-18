<?php
namespace LearnHub\MainApp\MainAppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LearnHub\MainApp\MainAppBundle\Entity\Media;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MediaTypes extends AbstractFixture implements OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $mediaTypes = [
            [
                'mediaType' => 'article',
                'icon' => 'fa-file-text-o',
                'iconType' => 'fa'
            ],
            [
                'mediaType' => 'movie',
                'icon' => 'fa-film',
                'iconType' => 'fa'
            ]
        ];
        
        foreach ($mediaTypes as $mediaType) {
            $newMediaType = new Media();
            $newMediaType->setName($mediaType['mediaType']);
            $newMediaType->setMime('asd');
            $newMediaType->setIcon($mediaType['icon']);
            $newMediaType->setIconType($mediaType['iconType']);
            $newMediaType->setMediaType($mediaType['mediaType']);
            $manager->persist($newMediaType);

            $this->addReference('media-'.$newMediaType->getName(),$newMediaType);
        }
        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }
}