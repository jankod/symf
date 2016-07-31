<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Util\MyControler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package AppBundle\Controller
 * @Route("/club")
 */
class ClubUserController extends MyControler
{


    /**
     * @Route("/users", name="club_users")
     */
    public function usersAction()
    {

        $this->checkUserLogger();

        /**
         * @var User
         */
        $user = $this->getUser();
        //$this->getDoctrine()->getRepository("AppBundle:Club")->find($user->getClub());
        //

        //  $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        // return new Response("Ovo je user club");
        return $this->render("club/user.html.twig", ["user" => $user]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * Route("/user" , name="club_user")
     */
    public function indexAction(Request $request)
    {

        $log = $this->get("logger");
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("msg", "Evo ga forma je dobra!");
            $user->setEmail("janko");

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, "janko");
            $user->setPassword($encoded);
            $user->setRoles(["ROLE_ADMIN"]);

            $m = $this->getDoctrine()->getManager();
            $m->persist($user);
            $m->flush();
            return $this->redirectToRoute('users');
        }
        return $this->render('club/user.html.twig', ["name" => "pero", 'form' => $form->createView()]);

    }


    /**
     * @return Response
     * @Route("/movies", name="mov")
     */
    public function listAction(Request $request)
    {
        return new Response("moveie je ovo Locale: " . $request->getLocale());

    }
}
