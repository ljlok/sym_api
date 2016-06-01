<?php
namespace Acme\BhiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController {

    public function getUserAction($id)
    {
        return $this->container->get('doctrine.entity_manager')->getRepository('User')->find($id);
    }

}


