<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rank
 *
 * @ORM\Table(name="rank")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\RankRepository")
 */
class Rank
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\Category", inversedBy="ranks")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="BackendBundle\Entity\User", inversedBy="ranks")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $rank;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set overallRank
//     *
//     * @param integer $overallRank
//     *
//     * @return Rank
//     */
//    public function setOverallRank($overallRank)
//    {
//        $this->overallRank = $overallRank;
//
//        return $this;
//    }

    /**
     * Get overallRank
     *
     * @return int
     */
    public function getOverallRank()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }


}

