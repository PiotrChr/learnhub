<?php
namespace LearnHub\MainApp\MainAppBundle\Services;

use Symfony\Component\Translation\MessageCatalogue;
use LearnHub\MainApp\MainAppBundle\Entity\LanguageTranslation;
use Symfony\Component\Translation\Loader\LoaderInterface;
use Doctrine\ORM\EntityManager;

class DBLoader implements LoaderInterface{
    private $transaltionRepository;
    private $languageRepository;

    /**@param EntityManager $entityManager*/
    public function __construct(EntityManager $entityManager){
        $this->transaltionRepository = $entityManager->getRepository("MainAppBundle:LanguageTranslation");
        $this->languageRepository = $entityManager->getRepository("MainAppBundle:Language");
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