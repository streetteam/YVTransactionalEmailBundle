<?php

namespace YV\TransactionalEmailBundle\Mailer;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

interface MailerInterface
{    
    public function findComposeAndSend($type, $recipient, array $context = array(), $locale = null);
    
    public function composeAndSend(TransactionalEmailInterface $transactionalEmail, $recipient, array $context = array());
}
