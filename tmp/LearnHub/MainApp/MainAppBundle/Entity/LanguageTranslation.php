<?php
namespace LearnHub\MainApp\MainAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="LearnHub\MainApp\MainAppBundle\Repository\LanguageTranslationRepository")
*/
class LanguageTranslation {

    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\column(type="string", length=200) */
    private $catalogue;


    /** @ORM\column(type="text") */
    private $translation;


    /**
     * @ORM\ManyToOne(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Language", fetch="EAGER")
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\LanguageToken", fetch="EAGER")
     */
    private $languageToken;


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCatalogue() {
        return $this->catalogue;
    }

    public function setCatalogue($catalogue) {
        $this->catalogue = $catalogue;
    }

    public function getTranslation() {
        return $this->translation;
    }

    public function setTranslation($translation) {
        $this->translation = $translation;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }

    public function getLanguageToken() {
        return $this->languageToken;
    }

    public function setLanguageToken($languageToken) {
        $this->languageToken = $languageToken;
    }
}