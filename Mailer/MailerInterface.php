<?php

namespace YV\TransactionalEmailBundle\Mailer;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

interface MailerInterface
{    
    public function findComposeAndSend($type, $recipient, array $context = array());
    
    public function composeAndSend(TransactionalEmailInterface $transactionalEmail, $recipient, array $context = array());
}
