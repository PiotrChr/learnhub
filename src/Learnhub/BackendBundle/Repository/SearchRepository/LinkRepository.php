<?php
namespace LearnHub\BackendBundle\Repository\SearchRepository;


use Elastica\Query\BoolQuery;

use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use Elastica\Query\Nested;
use Elastica\Query\QueryString;
use Elastica\Query\Term;
use Elastica\QueryBuilder\DSL\Query;
use FOS\ElasticaBundle\Repository;
use LearnHub\BackendBundle\Model\LinkSearch;

class LinkRepository extends Repository {
    
    public function search(LinkSearch $linkSearch)
    {
        $phrase = "*".$linkSearch->getName()."*";
        $queryString = new QueryString($phrase);

        $result = $this->find($queryString);

        die(dump($result));

        return $result;

    }
}