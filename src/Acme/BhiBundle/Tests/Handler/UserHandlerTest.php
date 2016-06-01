<?php
namespace Acme\BhiBundle\Tests\Handler;

use Acme\BhiBundle\Handler\UserHandler;
use Acme\BhiBundle\Model\UserInterface;
use Acme\BhiBundle\Entity\User;

class UserHandlerTest extends \PHPUnit_Framework_TestCase
    # PHPUnit_Framework_TestCase
{
    const USER_CLASS = 'Acme\BhiBundle\Tests\Handler\DummyUser';

    protected $userHandler;

    protected $om;

    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::USER_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::USER_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::USER_CLASS));
    }

    /*
    public function testGet()
    {
        $id = 1;
        $user = $this->getUser();
        $this->respository->expects($this->once())
            ->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($page));

        $this->userHandler->get($id); // call the get method

    }
     */

    public function testGet()
    {
        $id = 1;
        $user= $this->getUser();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($user));
        $this->userHandler = $this->createUserHandler($this->om, static::USER_CLASS,  $this->formFactory);
        $this->userHandler->get($id);
    }

    public function createUserHandler($objectManager, $userClass, $formFactory)
    {
        return new UserHandler($objectManager, $userClass, $formFactory);
    }

    public function getUser()
    {
        $userClass = static::USER_CLASS;
        return new $userClass();
    }

}

class DummyUser extends User
{

}
