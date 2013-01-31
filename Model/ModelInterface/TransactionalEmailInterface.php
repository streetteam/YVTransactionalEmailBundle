<?php

namespace YV\TransactionalEmailBundle\Model\ModelInterface;

interface TransactionalEmailInterface
{
    /**
     * Set name
     *
     * @param string $name
     * @return TransactionalEmailInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();  
    
    /**
     * Set type
     *
     * @param string $type
     * @return TransactionalEmailInterface
     */
    public function setType($type);

    /**
     * Get type
     *
     * @return string 
     */
    public function getType();  
    
    /**
     * Set subject
     *
     * @param string $subject
     * @return TransactionalEmailInterface
     */
    public function setSubject($subject);

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject();   
    
    /**
     * Set htmlBody
     *
     * @param string $htmlBody
     * @return TransactionalEmailInterface
     */
    public function setHtmlBody($htmlBody);

    /**
     * Get htmlBody
     *
     * @return string 
     */
    public function getHtmlBody();
    
    /**
     * Set textBody
     *
     * @param string $textBody
     * @return TransactionalEmailInterface
     */
    public function setTextBody($textBody);

    /**
     * Get textBody
     *
     * @return string 
     */
    public function getTextBody(); 
    
    /**
     * Set senderEmail
     *
     * @param string $senderEmail
     * @return TransactionalEmailInterface
     */
    public function setSenderEmail($senderEmail);

    /**
     * Get senderEmail
     *
     * @return string 
     */
    public function getSenderEmail(); 
    
    /**
     * Set senderName
     *
     * @param string $senderName
     * @return TransactionalEmailInterface
     */
    public function setSenderName($senderName);

    /**
     * Get senderName
     *
     * @return string 
     */
    public function getSenderName();  
}
