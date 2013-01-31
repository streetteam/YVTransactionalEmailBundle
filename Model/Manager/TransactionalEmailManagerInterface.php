<?php

namespace YV\TransactionalEmailBundle\Model\Manager;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

interface TransactionalEmailManagerInterface
{    
    public function getClassName();
    
    public function getRepository();
    
    public function getObjectManager();
    
    public function getEventDispatcher();  
    
    public function flush();
    
    public function persist(TransactionalEmailInterface $transactionalEmail);
    
    public function remove(TransactionalEmailInterface $transactionalEmail);    
    
    public function create();
    
    public function delete(TransactionalEmailInterface $transactionalEmail, $withFlush);    
    
    public function save(TransactionalEmailInterface $transactionalEmail, $withFlush);     
}
