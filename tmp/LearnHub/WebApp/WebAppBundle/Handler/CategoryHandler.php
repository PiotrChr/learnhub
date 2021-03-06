<?php

namespace LearnHub\WebApp\WebAppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use LearnHub\WebApp\WebAppBundle\Model\CategoryHandlerInterface;
use Doctrine\ORM\Mapping\Entity as ORM;

class CategoryHandler implements CategoryHandlerInterface {

    private $om;
    private $repository;
    private $entityClass;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;

        $this->repository = $this->om->getRepository('MainAppBundle:Category');
    }

    public function get($name)
    {
        $repo = [
            'entities' => $this->repository->createQueryBuilder('c')
                ->where('c.i18n_title LIKE :name')
                ->setParameter('name','%'.$name.'%')
                ->getQuery()
                ->getResult(),
            'repository' => $this->repository
        ];
        
        return $repo;
    }

    public function getAll() {
        $repo = [
            'entities' => $this->repository->findAll(),
            'repository' => $this->repository
        ];

        return $repo;
    }
}