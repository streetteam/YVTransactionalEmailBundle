<?php

namespace YV\TransactionalEmailBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

class TransactionalEmailListener
{    
    protected $defaultLocale;
    
    public function __construct($defaultLocale) 
    {
        $this->defaultLocale = $defaultLocale;
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->setLocaleIfEmpty($args);
    }
    
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->setLocaleIfEmpty($args);
    } 
    
    private function setLocaleIfEmpty(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        if($entity instanceof TransactionalEmailInterface) {
            if(!$entity->getLocale()) {
                $entity->setLocale($this->defaultLocale);
            }
        }        
    }
}
