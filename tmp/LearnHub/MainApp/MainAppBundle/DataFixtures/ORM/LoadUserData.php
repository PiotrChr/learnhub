<?php
namespace LearnHub\MainApp\MainAppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LearnHub\MainApp\MainAppBundle\Entity\Image;
use LearnHub\MainApp\MainAppBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use LearnHub\MainApp\MainAppBundle\Entity\AccessLevel;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $accessLevel = new AccessLevel();
        $accessLevel->setLevel(1);
        $accessLevel->setI18nTitle('access_levels.role_user');

        $manager->persist($accessLevel);

        $userAdmin = new User();
        $userAdmin->setUsername('chrusciel.piotr.87@gmail.com');
        $userAdmin->setIsActive(true);
        $userAdmin->setActivationToken(null);
        $userAdmin->setRole('ROLE_SUPERUSER');
        $userAdmin->setInitialRank(120);

        $avatar = new Image(
            'base64,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',
            'image/jpeg'
        );
        $manager->persist($avatar);
        $userAdmin->setAvatar($avatar);


        $encoder = $this->container->get('security.password_encoder');
        $userAdmin->setPassword($encoder->encodePassword($userAdmin,'asd'));

        $userAdmin->setAccessLevel($accessLevel);

        $this->addReference('user-admin',$userAdmin);
        $manager->persist($userAdmin);
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }
}

