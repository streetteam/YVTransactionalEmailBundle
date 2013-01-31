<?php
namespace YV\TransactionalEmailBundle\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

class FilterTransactionalEmailResponseEvent extends ResponseEvent
{
    protected $transactionalEmail;
    
    public function __construct(TransactionalEmailInterface $transactionalEmail, Request $request, Response $response) 
    {
        parent::__construct($request);
        
        $this->transactionalEmail = $transactionalEmail;
        $this->response = $response;
    }
    
    public function setTransactionalEmail(TransactionalEmailInterface $transactionalEmail)
    {
        $this->transactionalEmail = $transactionalEmail;
    }
    
    public function getTransactionalEmail()
    {
        return $this->transactionalEmail;
    }
}
