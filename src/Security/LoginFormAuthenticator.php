<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    private $entityManager;
    private $router;
    private $csrfTokenManager;

    public function __construct(EntityManagerInterface $entityManager, RouterInterface $router, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function supports(Request $request)
    {
        return 'app_login' === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // Check the user's password or other credentials and return true or false
        // If there are no credentials to check, you can just return true

        $password = $credentials['password'];

        if ($user->getPassword() === $password)
        {
            // echo 'Authenticated';
            return true; }
                else {
                    return false; }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
        {
            return new RedirectResponse($this->router->generate('message_index'));
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('app_login');
    }
}



// sources:
// https://symfony.com/doc/current/security.html#retrieving-the-user-object

// https://symfony.com/doc/current/security/form_login_setup.html

// https://silex.symfony.com/doc/2.0/cookbook/guard_authentication.html - to check credentials

// https://stackoverflow.com/questions/48968889/encoder-ispasswordvalid-must-implement-interface-userinterface

// https://github.com/symfony/symfony/issues/27311

// https://medium.com/@RudiRocha/creating-pages-with-symfony-4-1260cade7331

// https://symfony.com/doc/current/templating/twig_extension.html

// https://ourcodeworld.com/articles/read/245/how-to-execute-plain-sql-using-doctrine-in-symfony-3

// https://stackoverflow.com/questions/47845622/generating-crud-in-symfony-4

// https://symfony.com/doc/master/bundles/SensioGeneratorBundle/commands/generate_doctrine_crud.html

// https://stackoverflow.com/questions/35433295/how-to-customize-form-field-based-on-user-roles-in-symfony2-3
