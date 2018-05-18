<?php
namespace LearnHub\WebApp\WebAppBundle\Model;

use LearnHub\MainApp\MainAppBundle\Entity\Category;
use LearnHub\MainApp\MainAppBundle\Repository\CategoryRepository;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\Translator;


class CategoryAutocompleteDecorator {
    
    private $categoryCollection;
    private $repository;
    private $translator;

    public function __construct($categoryCollection, CategoryRepository $repository, DataCollectorTranslator $translator)
    {
        $this->translator = $translator;
        $this->categoryCollection = $categoryCollection;
        $this->repository = $repository;
    }

    public function getPath($entity) {
        return $this->repository->getPathQuery($entity)->getResult();
    }

    public function pathHtml($pathArray) {

        $pathHtml = '<ul class="categoryAutocomplete">';

        foreach ($pathArray as $item) {
            /** @var Category $item */
            // TODO: translate
            $pathHtml .= '<li>'.ucfirst($this->translator->trans($item->getI18nTitle())).'</li>';
        }

        $pathHtml .= '</ul>';
        return $pathHtml;
    }
    
    public function get() {
        $names = [];

        foreach ($this->categoryCollection as $entity) {
            /**
             * @var $entity Category
             * @var $repository CategoryRepository
             */
            $path = $this->getPath($entity);
            $pathHtml = $this->pathHtml($path);

            $names[] = [
                'name' => $entity->getI18nTitle(),
//                'path' => $path,
                'path_html' => $pathHtml,
                'id' => $entity->getId(),
                'childCount' => $this->repository->childCount($entity),
            ];
        }
        return $names;
    }
}