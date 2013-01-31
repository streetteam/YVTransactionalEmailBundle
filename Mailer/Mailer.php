<?php

namespace YV\TransactionalEmailBundle\Mailer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;

use YV\TransactionalEmailBundle\Model\Manager\TransactionalEmailManagerInterface;
use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

class Mailer extends \Swift_Mailer implements MailerInterface
{
    protected $transactionalEmailManager;
    
    protected $config;
    
    protected $twig;
    
    public function __construct(TransactionalEmailManagerInterface $transactionalEmailManager, \Swift_Transport $transport, \Twig_Environment $twig, array $config) 
    {
        parent::__construct($transport);
        
        $this->transactionalEmailManager = $transactionalEmailManager;
        $this->config = $config;
        
        $this->twig = clone $twig;

        $this->twig->setLoader(new \Twig_Loader_String());
    }
    
    public function findComposeAndSend($type, $recipient, array $context = array(), $locale = null)
    {
        $parameters = array(
            'type' => $type,
            'locale' => ($locale === null ? $this->config['default_locale'] : $locale),
        );
        $transactionalEmail = $this->transactionalEmailManager->getRepository()->findOneBy($parameters);
        
        if(!$transactionalEmail) {
            throw new InvalidArgumentException(sprintf('Transactional email type "%s" is not supported.', $type));
        }
        
        return $this->composeAndSend($transactionalEmail, $recipient, $context);
    }
    
    public function composeAndSend(TransactionalEmailInterface $transactionalEmail, $recipient, array $context = array())
    {
        if($this->config['email']['sending_enabled']) {

            $sender = $this->createSender($transactionalEmail);
            $subject = $this->twig->render($transactionalEmail->getSubject(), $context);
            $htmlBody = $this->twig->render($transactionalEmail->getHtmlBody(), $context);
            $textBody = $this->twig->render($transactionalEmail->getTextBody(), $context);        

            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($sender)
                ->setTo($recipient)
            ;

            if (!empty($htmlBody)) {
                $message->setBody($htmlBody, 'text/html')
                    ->addPart($textBody, 'text/plain');
            } else {
                $message->setBody($textBody);
            }        

            return $this->send($message);
        }
        
        return false;
    }
    
    private function createSender(TransactionalEmailInterface $transactionalEmail)
    {
            $senderName = $transactionalEmail->getSenderName() ? $transactionalEmail->getSenderName() : $this->config['email']['sender_name'];
            $senderEmail = $transactionalEmail->getSenderEmail() ? $transactionalEmail->getSenderEmail() : $this->config['email']['address'];
            
            return array($senderEmail => $senderName);        
    }
}
