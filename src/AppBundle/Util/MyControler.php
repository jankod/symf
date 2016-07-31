<?php
/**
 * Created by PhpStorm.
 * User: tag
 * Date: 31.7.2016.
 * Time: 11:53
 */

namespace AppBundle\Util;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MyControler extends Controller
{


    public function checkUserLogger()
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
    }

    public function disableProfiler()
    {

     //   $this->get("logger")->debug("Ovo je pozvano!!!");
        if ($this->container->has('profiler')) {
            $this->container->get('profiler')->disable();
        }
    }
}