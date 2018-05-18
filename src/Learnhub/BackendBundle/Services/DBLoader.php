<?php
namespace LearnHub\BackendBundle\Services;

use Symfony\Component\Translation\MessageCatalogue;
use LearnHub\BackendBundle\Entity\LanguageTranslation;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Doctrine\ORM\EntityManager;

class DBLoader implements LoaderInterface{
    private $transaltionRepository;
    private $languageRepository;

    /**@param EntityManager $entityManager*/
    public function __construct(EntityManager $entityManager){
        $this->transaltionRepository = $entityManager->getRepository("BackendBundle:LanguageTranslation");
        $this->languageRepository = $entityManager->getRepository("BackendBundle:Language");
    }

    function load($resource, $locale, $domain = 'messages'){
        //Load on the db for the specified local
        $language = $this->languageRepository->getLanguage($locale);

        $translations = $this->transaltionRepository->getTranslations($language, $domain);

        $catalogue = new MessageCatalogue($locale);

        /**@var $translation LanguageTranslation */
        foreach($translations as $translation){
            $catalogue->set($translation->getLanguageToken()->getToken(), $translation->getTranslation(), $domain);
        }

        return $catalogue;
    }
}