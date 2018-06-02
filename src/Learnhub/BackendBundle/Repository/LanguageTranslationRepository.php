<?php
namespace BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class LanguageTranslationRepository extends EntityRepository{
    /**
    * Return all translations for specified token
    * @param $language string
    * @param $catalogue string
    * @return mixed
    */
    public function getTranslations($language, $catalogue = "messages"){
        $query = $this->getEntityManager()->createQuery("SELECT t FROM BackendBundle:LanguageTranslation t WHERE t.language = :language AND t.catalogue = :catalogue");
        $query->setParameter("language", $language);
        $query->setParameter("catalogue", $catalogue);

        return $query->getResult();
    }
}
