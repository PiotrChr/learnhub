<?php
namespace BackendBundle\Security;

use BackendBundle\Entity\User;
use BackendBundle\Exceptions\AccountInactiveException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Security;

class FormLoginAuthenticator extends AbstractFormLoginAuthenticator {

    private $router;
    private $encoder;
    private $path;
    private $request;

    public function __construct(RouterInterface $router, UserPasswordEncoderInterface $encoder, $path, RequestStack $request) {
        $this->router = $router;
        $this->encoder = $encoder;
        // FIXME: rename this variable, nobody knows what it means
        $this->path = $path;
        $this->request = $request;
    }

    public function supports(Request $request)
    {
        // TODO: Implement supports() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }


    protected function getLoginUrl()
    {
        return $this->router->generate('web_app_signin');
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('web_app_homepage');
    }

    public function getCredentials(Request $request)
    {
        if ($request->getPathInfo() != $this->path) {
            return null;
        }

        $loginRequest = $request->request->get('login');
        $username = $loginRequest['_username'];
        $password = $loginRequest['_password'];

        $request->getSession()->set(Security::LAST_USERNAME, $username);

        // FIXME: return entity
        return [
            'username' => $username,
            'password' => $password,
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];
        return $userProvider->loadUserByUsername($username);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $plainPassword = $credentials['password'];

        if ($this->encoder->isPasswordValid($user, $plainPassword)) {

            /** @var $user User **/
            if ($user->getIsActive()) {
                // Set user details in session
                // FIXME: Add a proper entity here
                $login = new Login();
                $login->setUsername($user->getUsername());

                // TODO: token
                $login->setToken(date('Ymd'));
                $this->request->getCurrentRequest()->getSession()->set('login',$login);

                return true;
            }
            throw new AccountInactiveException();
        }
        throw new BadCredentialsException();
    }



}
