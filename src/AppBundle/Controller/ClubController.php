<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Util\MyControler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClubController
 * @package AppBundle\Controller
 * @Route("/club")
 */
class ClubController extends MyControler
{


    /**
     * @Route("/index", name="clubIndex")
     */
    public function indexAction()
    {

        return $this->render("club/index.html.twig");

    }


}
