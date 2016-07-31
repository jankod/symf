<?php
/**
 * Created by PhpStorm.
 * User: tag
 * Date: 30.7.2016.
 * Time: 22:39
 */

namespace AppBundle\Util;


use Symfony\Bundle\FrameworkBundle\Controller\Controlle;

class Util
{
    public static function checkUserLogger(Controller $controller)
    {
        if (!$controller->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $controller->createAccessDeniedException();
        }

    }
}