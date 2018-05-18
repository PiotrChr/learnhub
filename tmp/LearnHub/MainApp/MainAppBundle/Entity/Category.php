<?php

namespace LearnHub\MainApp\MainAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\ElasticaBundle\Annotation\Search;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="LearnHub\MainApp\MainAppBundle\Repository\CategoryRepository")
 * @Search()
 * */
class Category {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * */
    protected $id;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer",nullable=true)
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer",nullable=true)
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer",nullable=true)
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE",nullable=true)
     */
    private $root;

    /**
    * @Gedmo\TreeParent
    * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
    * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
*/
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @ORM\Column(type="string")
     * */
    protected $i18n_title;

    /**
     * @ORM\OneToMany(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Rank", mappedBy="category")
     * */
    protected $ranks;

    /**
     * @ORM\Column(type="text", nullable=true)
     * */
    protected $description;
    
    /**
     * @Gedmo\Slug(fields={"i18n_title","id"}, updatable=false)
     * @ORM\Column(type="string", length=255, unique=true)
     * */
    protected $slug;

    /**
     * @param $i18n_title string
     */
    public function __construct($i18n_title)
    {
        $this->i18n_title = $i18n_title;

    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getI18nTitle()
    {
        return $this->i18n_title;
    }

    /**
     * @param mixed $i18n_title
     */
    public function setI18nTitle($i18n_title)
    {
        $this->i18n_title = $i18n_title;
    }

    public function setParent(Category $parent) {
        $this->parent = $parent;
    }

    public function getParent() {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @param mixed $lft
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    }

    /**
     * @return mixed
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param mixed $lvl
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    }

    /**
     * @return mixed
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * @param mixed $rgt
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    }

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }
}

