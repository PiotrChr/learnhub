<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 7/26/16
 * Time: 4:45 PM
 */

namespace LearnHub\MainApp\MainAppBundle\Model;

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