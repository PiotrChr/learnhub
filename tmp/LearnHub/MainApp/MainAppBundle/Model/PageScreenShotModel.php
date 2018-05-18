<?php
namespace LearnHub\MainApp\MainAppBundle\Model;

class PageScreenShotModel {

    protected $imageData;
    protected $width;
    protected $height;
    protected $mime;

    public function __construct($imageData,$width,$height,$mime)
    {
        $this->imageData = $imageData;
        $this->width = $width;
        $this->height = $height;
        $this->mime = $mime;
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


}