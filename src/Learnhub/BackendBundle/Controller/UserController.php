<?php

namespace BackendBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Repository\RepositoryFactory;
use FOS\RestBundle\Controller\FOSRestController;
use BackendBundle\Repository\UserRepository;
use BackendBundle\Services\ElasticSearch\ElasticSearch;
use PhpOption\Tests\Repository;
use Symfony\Component\HttpFoundation\Request;

class UserController extends FOSRestController {

    protected $elastic;
    private $initiated = false;

    public function init()
    {
        $finder = $this->get('fos_elastica.finder.learnhub.user');
        $this->elastic = $this->get('backend.elastic');
        $this->elastic->setFinder($finder);
        $this->initiated = true;
    }

    public function copyUserAction($id) // RFC-2518
    {} // "copy_user"            [COPY] /users/{id}

    public function propfindUserPropsAction($id, $property) // RFC-2518
    {} // "propfind_user_props"  [PROPFIND] /users/{id}/props/{property}

    public function proppatchUserPropsAction($id, $property) // RFC-2518
    {} // "proppatch_user_props" [PROPPATCH] /users/{id}/props/{property}

    public function moveUserAction($id) // RFC-2518
    {} // "move_user"            [MOVE] /users/{id}

    public function mkcolUsersAction() // RFC-2518
    {} // "mkcol_users"          [MKCOL] /users

    public function optionsUsersAction()
    {} // "options_users"        [OPTIONS] /users

    public function getUsersAction()
    {
        if (!$this->initiated) $this->init();

        $output = $this->elastic->getUsers();

        $view = $this->view($output,200);
        return $this->handleView($view);
    } // "get_users"            [GET] /users

    public function newUsersAction()
    {} // "new_users"            [GET] /users/new

    public function postUsersAction()
    {} // "post_users"           [POST] /users

    public function patchUsersAction()
    {} // "patch_users"          [PATCH] /users

    public function getUserAction($slug)
    {
        if (!$this->initiated) $this->init();
        $em = $this->get('doctrine.orm.default_entity_manager');
        $repository = $em->getRepository('BackendBundle:User');
        $user = $repository->findOneBy(['id'=>(int)$slug]);

        $view = $this->view($user,200);

        return $this->handleView($view);
    } // "get_user"             [GET] /users/{slug}

    public function editUserAction($slug)
    {} // "edit_user"            [GET] /users/{slug}/edit

    public function putUserAction($slug)
    {} // "put_user"             [PUT] /users/{slug}

    public function patchUserAction($slug)
    {} // "patch_user"           [PATCH] /users/{slug}

    public function lockUserAction($slug)
    {} // "lock_user"            [LOCK] /users/{slug}

    public function unlockUserAction($slug)
    {} // "unlock_user"          [UNLOCK] /users/{slug}

    public function banUserAction($slug)
    {} // "ban_user"             [PATCH] /users/{slug}/ban

    public function removeUserAction($slug)
    {} // "remove_user"          [GET] /users/{slug}/remove

    public function deleteUserAction($slug)
    {} // "delete_user"          [DELETE] /users/{slug}

    public function getUserCommentsAction($slug)
    {} // "get_user_comments"    [GET] /users/{slug}/comments

    public function newUserCommentsAction($slug)
    {} // "new_user_comments"    [GET] /users/{slug}/comments/new

    public function postUserCommentsAction($slug)
    {} // "post_user_comments"   [POST] /users/{slug}/comments

    public function getUserCommentAction($slug, $id)
    {} // "get_user_comment"     [GET] /users/{slug}/comments/{id}

    public function editUserCommentAction($slug, $id)
    {} // "edit_user_comment"    [GET] /users/{slug}/comments/{id}/edit

    public function putUserCommentAction($slug, $id)
    {} // "put_user_comment"     [PUT] /users/{slug}/comments/{id}

    public function postUserCommentVoteAction($slug, $id)
    {} // "post_user_comment_vote" [POST] /users/{slug}/comments/{id}/votes

    public function removeUserCommentAction($slug, $id)
    {} // "remove_user_comment"  [GET] /users/{slug}/comments/{id}/remove

    public function deleteUserCommentAction($slug, $id)
    {} // "delete_user_comment"  [DELETE] /users/{slug}/comments/{id}

    public function linkUserAction($slug)
    {} // "link_user_friend"     [LINK] /users/{slug}

    public function unlinkUserAction($slug)
    {} // "unlink_user_friend"     [UNLINK] /users/{slug}
}