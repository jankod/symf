<?php
/**
 * Created by PhpStorm.
 * User: tag
 * Date: 31.7.2016.
 * Time: 19:29
 */

namespace AppBundle\Service;


use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    private $router;
    /**
     * @var Registry
     */
    private $registry;

    public function __construct(RouterInterface $router, Registry $registry)
    {
        $this->router = $router;
        $this->registry = $registry;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        /* default route */
        //$url = $this->router->generate('default');
        /* get the roles
        $roles = $token->getUser()->getRoles();
        foreach ($roles as $role) {
            if ($role == 'ROLE_MODERATOR') {
                $url = $this->router->generate('moderator_dashboard');
            } else {
                $url = $this->router->generate('fos_user_profile_show');
            }
        }
        */

        /**
         * @var \AppBundle\Entity\User
         */
        $user = $token->getUser();
        $repo = $this->registry->getRepository("AppBundle:User");
        //&&$this->registry->getManager()->refresh()
        // &&$u = $repo->find($user->getId());6
        $url = $this->router->generate("clubIndex");
        $request->getSession()->set("user_id", $user->getClub()->getName());
        return new RedirectResponse($url);
    }
}