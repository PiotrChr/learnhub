<?php
namespace BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Gedmo\Tree\Traits\MaterializedPath;
use Gedmo\Tree\Traits\NestedSet;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

class TagRepository extends NestedTreeRepository {

    public function __construct(EntityManager $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);

//        $this->initializeTreeRepository($em, $class);
    }
}
