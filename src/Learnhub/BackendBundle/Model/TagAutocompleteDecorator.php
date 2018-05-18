<?php
namespace BackendBundle\Model;

use Doctrine\ORM\EntityRepository;
use BackendBundle\Entity\Category;
use BackendBundle\Repository\CategoryRepository;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;
use BackendBundle\Entity\Tag;

class TagAutocompleteDecorator {

    private $translator;

    public function __construct($tagCollection, DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
        $this->tagCollection = $tagCollection;
    }

    public function get() {
        $names = [];

        foreach ($this->tagCollection as $entity) {
            /**
             * @var $entity Tag
             */

            $names[] = [
                'name' => $entity->getName(),
                'id' => $entity->getId()
            ];
        }
        return $names;
    }
}