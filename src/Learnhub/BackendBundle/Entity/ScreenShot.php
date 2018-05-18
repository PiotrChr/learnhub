<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BackendBundle\Model\PageScreenShotModel;


/**
 * @ORM\Entity()
 * @ORM\Table(name="screen_shot")
 * */
class ScreenShot {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * */
    protected $id;

    /**
     * @var $link
     * @ORM\ManyToOne(targetEntity="Link", inversedBy="screenShot")
     * @ORM\JoinColumn(name="link_id", referencedColumnName="id")
     * */
     
    protected $link;

    /**
     * @var $imageData
     * @ORM\Column(type="text")
     * */
    protected $imageData;

    /**
     * @var $mime
     * @ORM\Column(type="text")
     * */
    protected $mime;

    /**
     * @var $width
     * @ORM\Column(type="integer")
     * */
    protected $width;

    /**
     * @var $height
     * @ORM\Column(type="integer")
     * */
    protected $height;

    public function create(PageScreenShotModel $shotModel) 
    {
        $this->setHeight($shotModel->getHeight());
        $this->setWidth($shotModel->getWidth());
        $this->setImageData($shotModel->getImageData());
        $this->setMime($shotModel->getMime());
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getImageData()
    {
        return $this->imageData;
    }

    /**
     * @param mixed $imageData
     */
    public function setImageData($imageData)
    {
        $this->imageData = $imageData;
    }

    /**
     * @return mixed
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * @param mixed $mime
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink(Link $link)
    {
        $this->link = $link;
    }

}
