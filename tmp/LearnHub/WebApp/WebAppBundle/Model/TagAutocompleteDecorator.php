<?php
namespace LearnHub\WebApp\WebAppBundle\Model;

use Doctrine\ORM\EntityRepository;
use LearnHub\MainApp\MainAppBundle\Entity\Category;
use LearnHub\MainApp\MainAppBundle\Repository\CategoryRepository;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;
use LearnHub\MainApp\MainAppBundle\Entity\Tag;

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