<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ImageRepository")
 */
class Image
{

    public function __construct($base64,$mime) {
        $this->base64 = $base64;
        $this->mime = $mime;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="base64", type="text")
     */
    private $base64;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=255)
     */
    private $mime;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set base64
     *
     * @param string $base64
     *
     * @return Image
     */
    public function setBase64($base64)
    {
        $this->base64 = $base64;

        return $this;
    }

    /**
     * Get base64
     *
     * @return string
     */
    public function getBase64()
    {
        return $this->base64;
    }

    /**
     * Set mime
     *
     * @param string $mime
     *
     * @return Image
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string
     */
    public function getMime()
    {
        return $this->mime;
    }
}

