<?php

namespace BackendBundle\Model;

use Symfony\Component\HttpFoundation\Request;

class LinkSearch
{
    protected $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return LinkSearch
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
