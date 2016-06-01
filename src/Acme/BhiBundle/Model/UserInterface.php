<?php


namespace Acme\BhiBundle\Model;

Interface UserInterface
{
    public function setUsername($username);

    public function getUsername();

    public function setPassword($password);

    public function getPassword();
}
