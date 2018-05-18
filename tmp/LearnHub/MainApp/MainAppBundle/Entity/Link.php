<?php

namespace LearnHub\MainApp\MainAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use LearnHub\MainApp\MainAppBundle\Entity\Category;
use FOS\ElasticaBundle\Annotation\Search;

/**
 * @ORM\Entity()
 * @ORM\Table(name="link")
 * @Search(repositoryClass="LearnHub\MainApp\MainAppBundle\Repository\SearchRepository\LinkRepository")
 * */
class Link {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * */
    protected $id;

    /**
     * @var $url
     * @ORM\Column(type="text")
     * */
    protected $url;

    /**
     * @var array $category
     *
     * @ORM\ManyToOne(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Category")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="ScreenShot", mappedBy="link", cascade={"remove"})
     * */
    protected $screenShot;

    /**
     * @ORM\ManyToOne(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     * */
    protected $author;

    /**
     * @var $datetime
     * @ORM\Column(type="datetime")
     * */
    protected $datetime;

    /**
     * @ORM\Column(type="string", nullable=true)
     * */
    protected $i18nTitle;

    /**
     * @Gedmo\Slug(fields={"name","id"}, updatable=false)
     * @ORM\Column(type="string", length=255, unique=true)
     * */
    protected $slug;

    /**
     * @ORM\Column(type="string")
     * */
    protected $name;

    /**
     * @var array $media
     * @ORM\ManyToMany(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Media")
     * @ORM\JoinTable(name="link_media",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id")}
     *      )
     */
    protected $media;

    /**
     * @var array $tag
     * @ORM\ManyToMany(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Tag")
     * @ORM\JoinTable(name="link_tag",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id", onDelete="cascade")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    protected $tag;

    /**
    * @ORM\Column(type="text",nullable=true)
     */
    protected $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->screenShot = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->tag = new ArrayCollection();
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(Category $category)
    {

        $this->category = $category;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }

    /**
     * @return mixed
     */
    public function getScreenShot()
    {
        return $this->screenShot;
    }

    /**
     * @param mixed $screenShot
     */
    public function setScreenShot(ScreenShot $screenShot)
    {
        $this->screenShot->clear();
        $this->screenShot->add($screenShot);
    }

    /**
     * @param mixed $screenShot
     */
    public function addScreenShot(ScreenShot $screenShot)
    {
        $this->screenShot->add($screenShot);
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return array
     */
    public function getMediaAsArray()
    {
        return $this->media->toArray();
    }

    /**
     * @param mixed $media
     */
    public function setMedia($media)
    {
        $this->media->clear();
        $this->media->add($media);
    }

    public function addMedia($media) {
        $this->media->add($media);
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag)
    {
        $this->media->clear();
        $this->media->add($tag);
    }

    public function addTag(Tag $tag) {
        $this->tag->add($tag);
    }

    public function getTagsAsArray() {
        return $this->getTag()->toArray();
    }

    /**
     * @return mixed
    */
    public function getTag() {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
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


}
