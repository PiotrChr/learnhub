<?php
namespace LearnHub\MainApp\MainAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="LearnHub\MainApp\MainAppBundle\Repository\LanguageTokenRepository")
*/
class LanguageToken {

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    private $id;

    /** @ORM\column(type="string", length=200, unique=true) */
    private $token;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }
}