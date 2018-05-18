<?php

namespace LearnHub\WebApp\WebAppBundle\Controller;

use Doctrine\ORM\EntityManager;

use FOS\ElasticaBundle\Repository;
use LearnHub\MainApp\MainAppBundle\Entity\Category;
use LearnHub\MainApp\MainAppBundle\Model\ElasticMapper;
use LearnHub\MainApp\MainAppBundle\Model\LinkSearch;
use LearnHub\MainApp\MainAppBundle\Repository\CategoryRepository;
use LearnHub\WebApp\WebAppBundle\Model\CategoryAutocompleteDecorator;
use LearnHub\WebApp\WebAppBundle\Model\TagAutocompleteDecorator;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zend\Json\Json;

class AController extends Controller
{

    public function indexAction() {
        return ['asd'];
    }

    public function getTagByNameAction(Request $request) {
        $handler = $this->get('web_app_bundle.api.tag.handler')->get($request->get('query'));
        $decorator = new TagAutocompleteDecorator($handler['entities'], $this->get('translator'));
        return new JsonResponse($decorator->get());
    }

    public function getCategoryByNameAction(Request $request) {
        $handler = $this->get('web_app_bundle.api.category.handler')->get($request->get('query'));
        $decorator = new CategoryAutocompleteDecorator($handler['entities'],$handler['repository'], $this->get('translator'));
        return new JsonResponse($decorator->get());
    }

    public function elasticAction(Request $request) {

        $search = new LinkSearch();
        $search->setName($request->get('p'));

        $elasticaManager = $this->get('fos_elastica.finder.learnhub');

        $results = $elasticaManager->find('*'.$search->getName().'*',10);

        die(dump($results));

        $elasticOutput = new ElasticMapper($results);

        return new JsonResponse($elasticOutput->save());

    }
}
