<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 7/31/16
 * Time: 5:28 PM
 */
namespace LearnHub\BackendBundle\Transformer;

use Elastica\Document;
use FOS\ElasticaBundle\Transformer\ModelToElasticaAutoTransformer;
use BackendBundle\Entity\Link;

class LinkToElasticaTransformer extends ModelToElasticaAutoTransformer {

    /**
     * Transforms an object into an elastica object having the required keys.
     *
     * @param object $object the object to convert
     * @param array  $fields the keys we want to have in the returned array
     *
     * @return Document
     **/
    public function transform($object, array $fields)
    {
        $identifier = $this->propertyAccessor->getValue($object, $this->options['identifier']);
        $document = $this->transformObjectToDocument($object, $fields, $identifier);

        /** @var $object Link*/
        $document->setParent($object->getCategory()->getId());
        return $document;
    }
}
