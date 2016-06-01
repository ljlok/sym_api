<?php

namespace Acme\BhiBundle\Handler;

use Acme\BhiBundle\Model\UserInterface;

Interface UserHandlerInterface
{
    /*
     *  Get a User given the identifier
     *
     */
    public function get($id);


}



