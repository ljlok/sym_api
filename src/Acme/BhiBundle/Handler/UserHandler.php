<?php
namespace Acme\BhiBundle\Handler;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Acme\BhiBundle\Model\UserInterface;
use Acme\BhiBundle\Form\UserType;
use Acme\BhiBundle\Exception\InvalidFormException;

class UserHandler implements UserHandlerInterface
{
    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->respository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * @ Get a User
     *
     */
    public function get($id)
    {
        return $this->respository->find($id);
    }

}


