<?php
namespace BackendBundle\Security\User;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;


class UserProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function loadUserById($id) {
        $repository = $this->em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(array('id' => $id));
        return $user;
    }

    public function loadUserByUsername($username)
    {
        $repository = $this->em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(array('username' => $username));
        return $user;
    }

    public function loadActiveUserByUsername($username) {
        $repository = $this->em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(array('username' => $username,'is_active' => true));
        return $user;
    }

    public function getUserForApiKey($apiKey) {
        $repository = $this->em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(array('api_key' => $apiKey));
        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }
}
