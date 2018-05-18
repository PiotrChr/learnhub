<?php

namespace BackendBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use BackendBundle\Model\HandlerInterface;
use Doctrine\ORM\Mapping\Entity as ORM;

class TagHandler implements HandlerInterface {

    private $om;
    private $repository;
    private $entityClass;

    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->repository = $this->om->getRepository('BackendBundle:Tag');
    }

    public function get($name)
    {
        $repo = [
            'entities' => $this->repository->createQueryBuilder('c')
                ->where('c.name LIKE :name')
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