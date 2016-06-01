<?php
namespace Acme\BhiBundle\Tests\Fixtures\Entity;
use Acme\BhiBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData implements FixtureInterface
{
    static public $users = array();

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('username');
        $user->setPassword('password');
        $manager->persist($user);
        $manager->flush();
        self::$users[] = $user;
    }
}
