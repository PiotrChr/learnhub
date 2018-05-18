<?php

namespace LearnHub\MainApp\MainAppBundle\Model;

use LearnHub\MainApp\MainAppBundle\Entity\Category;
use LearnHub\MainApp\MainAppBundle\Entity\Link;

class ElasticMapper {

    private $resultsIn;
    private $resultsOut;
    private $parentPlaceholder = 'root';

    public function __construct(array $resultsIn)
    {
        $this->resultsIn = $resultsIn;
        $this->resultsOut = [];
    }

    public function save()
    {
        foreach($this->resultsIn as $object) {

            if ($object instanceof Link) {

                $parent = ($object->getCategory() instanceof Category) ? $object->getCategory()->getI18nTitle() : $this->parentPlaceholder;

                $out = [
                    'type' => 'link',
                    'parameters' => [
                        'name' => $object->getName(),
                        'url' => $object->getUrl(),
                        'parent' => $parent,
                        'slug' => $object->getSlug()
                    ]
                ];

            } else if ($object instanceof Category) {

                $parent = ($object->getParent() instanceof Category) ? $object->getParent()->getI18nTitle() : $this->parentPlaceholder;
                
                $out = [
                    'type' => 'category',
                    'parameters' => [
                        'name' => $object->getI18nTitle(),
                        'parent' => $parent,
                        'slug' => $object->getSlug()
                    ]
                ];
            }
            $out['id'] = $object->getId();
            $this->resultsOut[] = $out;

        }

        return $this->resultsOut;
    }

    public function getResults() {
        return $this->resultsOut;
    }
}