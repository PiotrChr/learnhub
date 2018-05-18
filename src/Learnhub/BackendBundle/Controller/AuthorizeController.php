<?php
namespace BackendBundle\Controller;

use FOS\OAuthServerBundle\Controller\AuthorizeController as BaseAuthorizeController;
use BackendBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorizeController extends BaseAuthorizeController {
    public function authorizeAction(Request $request) {

        $clientId = $request->get('client_id');

        if (!$clientId) {
            throw new NotFoundHttpException("Client id parameter {$request->get('client_id')} is missing.");
        }

        $clientManager = $this->container->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->findClientByPublicId($clientId);

        if (!($client instanceof Client)) {
            throw new NotFoundHttpException("Client {$request->get('client_id')} is not found.");
        }

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $this->container->get('fos_oauth_server.client_manager.default');
    }
}