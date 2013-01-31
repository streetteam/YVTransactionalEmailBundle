<?php

namespace YV\TransactionalEmailBundle\Model\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Doctrine\Common\Persistence\ObjectManager;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

class TransactionalEmailManager implements TransactionalEmailManagerInterface
{
    protected $objectManager;
    
    protected $eventDispatcher;
    
    protected $repository;
    
    protected $className;
    
    public function __construct(ObjectManager $objectManager, EventDispatcherInterface $eventDispatcher, $className) 
    {
        $this->objectManager = $objectManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->className = $className;
        $this->repository = $this->objectManager->getRepository($this->className);
    }
    
    public function getClassName()
    {
        return $this->className;
    }
    
    public function getRepository()
    {
        return $this->repository;
    }
    
    public function getObjectManager()
    {
        return $this->objectManager;
    }
    
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
    
    public function flush()
    {
        $this->objectManager->flush();
    }
    
    public function persist(TransactionalEmailInterface $transactionalEmail)
    {
        $this->objectManager->persist($transactionalEmail);
    }
    
    public function remove(TransactionalEmailInterface $transactionalEmail)
    {
        $this->objectManager->remove($transactionalEmail);
    }    
    
    public function create()
    {
        return new $this->className();
    }
    
    public function delete(TransactionalEmailInterface $transactionalEmail, $withFlush = true)
    {
        $this->remove($transactionalEmail);
        
        if($withFlush) {
            $this->flush();
        }
    }    
    
    public function save(TransactionalEmailInterface $transactionalEmail, $withFlush = true)
    {
        $this->persist($transactionalEmail);
        
        if($withFlush) {
            $this->flush();
        }
    }    
}
