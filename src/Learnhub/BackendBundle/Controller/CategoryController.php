<?php

namespace BackendBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class CategoryController extends FOSRestController {

    private $elastic;
    private $initiated;

    private function init() {
        $finder = $this->get('fos_elastica.finder.learnhub.category');
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
//    {} // "move_user"            [MOVE] /users/{id}
//
//    public function mkcolUsersAction() // RFC-2518
//    {} // "mkcol_users"          [MKCOL] /users
//
//    public function optionsUsersAction()
//    {} // "options_users"        [OPTIONS] /users

    public function getCategoriesAction()
    {
        if (!$this->initiated) $this->init();

        $output = $this->elastic->getCategories();

        $view = $this->view($output,200);
        return $this->handleView($view);
    } // "get_users"            [GET] /categories

    public function newCategoriesAction()
    {} // "new_users"            [GET] /users/new

    public function postCategoriesAction()
    {} // "post_users"           [POST] /users

    public function patchCategoriesAction()
    {} // "patch_users"          [PATCH] /users

    public function getCategoryAction($slug)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $repository = $em->getRepository('BackendBundle:Category');
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