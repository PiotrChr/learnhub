<?php

namespace BackendBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Model\HandlerInterface;

class CategoryHandler implements HandlerInterface {

    private $om;
    private $repository;


    public function __construct(ObjectManager $om, $entityClass)
    {
        $this->om = $om;
        $this->repository = $this->om->getRepository('BackendBundle:Category');
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