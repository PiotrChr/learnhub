<?php

namespace LearnHub\MainApp\MainAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(name="access_level")
 * */
class AccessLevel {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     * */
    protected $level;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="accessLevel")
     * */
    protected $users;

    /**
     * @ORM\Column(type="string")
     * */
    protected $i18nTitle;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Add user
     *
     * @param \LearnHub\MainApp\MainAppBundle\Entity\User $user
     *
     * @return AccessLevel
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \LearnHub\MainApp\MainAppBundle\Entity\User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getI18nTitle()
    {
        return $this->i18nTitle;
    }

    /**
     * @param mixed $i18nTitle
     */
    public function setI18nTitle($i18nTitle)
    {
        $this->i18nTitle = $i18nTitle;
    }
    
    
}
