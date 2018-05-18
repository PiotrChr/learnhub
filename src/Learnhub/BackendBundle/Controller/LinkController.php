<?php

namespace BackendBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class LinkController extends FOSRestController {

    private $elastic;
    private $initiated;

    private function init() {
        $finder = $this->get('fos_elastica.finder.learnhub.link');
        $this->elastic = $this->get('backend.elastic');
        $this->elastic->setFinder($finder);
        $this->initiated = true;
    }

//    public function copyUserAction($id) // RFC-2518
//    {} // "copy_user"            [COPY] /users/{id}
//
//    public function propfindUserPropsAction($id, $property) // RFC-2518
//    {} // "propfind_user_props"  [PROPFIND] /users/{id}/props/{property}
//
//    public function proppatchUserPropsAction($id, $property) // RFC-2518
//    {} // "proppatch_user_props" [PROPPATCH] /users/{id}/props/{property}
//
//    public function moveUserAction($id) // RFC-2518
//    {} // "move_user"            [MOVE] /links/{id}
//
//    public function mkcolUsersAction() // RFC-2518
//    {} // "mkcol_users"          [MKCOL] /links
//
//    public function optionsUsersAction()
//    {} // "options_users"        [OPTIONS] /links

    public function getLinksAction()
    {
        if (!$this->initiated) $this->init();
        $output = $this->elastic->getLinks();

        $view = $this->view($output,200);
        return $this->handleView($view);
    } // "get_users"            [GET] /links

    public function newLinksAction()
    {} // "new_users"            [GET] /links/new

    public function postLinksAction()
    {} // "post_users"           [POST] /links

    public function patchLinksAction()
    {} // "patch_users"          [PATCH] /links

    public function getLinkAction($slug)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $repository = $em->getRepository('BackendBundle:Link');
        $categories = $repository->findOneBy(['id'=>(int)$slug]);

        $view = $this->view($categories,200);

        return $this->handleView($view);
    } // "get_user"             [GET] /users/{slug}

    public function editCategoryAction($slug)
    {} // "edit_user"            [GET] /users/{slug}/edit

    public function putCategoryAction($slug)
    {} // "put_user"             [PUT] /users/{slug}

    public function patchCategoryAction($slug)
    {} // "patch_user"           [PATCH] /users/{slug}

    public function removeCategoryAction($slug)
    {} // "remove_user"          [GET] /users/{slug}/remove

    public function deleteCategoryAction($slug)
    {} // "delete_user"          [DELETE] /users/{slug}

}