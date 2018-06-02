<?php
namespace BackendBundle\Services\ElasticSearch;

use FOS\ElasticaBundle\Finder\TransformedFinder;
use BackendBundle\Decorators\MicroTimeDecorator;

class ElasticSearch {

    private $finder;

    public function setFinder(TransformedFinder $finder) {
        $this->finder = $finder;
    }

    public function mainSearch($phrase) {
        $micro = microtime(true);

        $results = $this->findPaginated($phrase, 10, 1);
        $duration = new MicroTimeDecorator(microtime(true) - $micro);

        return $results->getCurrentPageResults();
    }

    public function simpleSearch($phrase = '') {
        $result = $this->findPaginated($phrase, 10, 1);
        return $result->getCurrentPageResults();
    }

    public function getLinks($phrase = '') {
        return $this->simpleSearch($phrase);
    }

    public function getCategories($phrase = '') {
        return $this->simpleSearch($phrase);
    }

    public function getUsers($phrase = '') {
        return $this->simpleSearch($phrase);
    }

    private function findPaginated($phrase = '', $maxPerPage, $currentPage) {
        $results = $this->finder->findPaginated('*'.$phrase.'*');
        $results->setMaxPerPage($maxPerPage);
        $results->setCurrentPage($currentPage);
        return $results;
    }
}
