<?php

namespace YV\TransactionalEmailBundle\Model;

use Doctrine\ORM\Mapping as ORM;

use YV\TransactionalEmailBundle\Model\ModelInterface\TransactionalEmailInterface;

/**
 * A transactional email, which may be sent to recipients
 * 
 * @ORM\MappedSuperclass
 */
abstract class TransactionalEmail implements TransactionalEmailInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * The email name
     * 
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;    
    
    /**
     * The transactional email unique type
     * 
     * @ORM\Column(name="type", type="string", length=50, unique=true, nullable=false)
     */
    protected $type;  
    
    /**
     * The email subject
     * 
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    protected $subject;  
    
    /**
     * The email HTML body
     * 
     * @ORM\Column(name="html_body", type="text", nullable=true)
     */
    protected $htmlBody;
    
    /**
     * The email text body
     * 
     * @ORM\Column(name="text_body", type="text", nullable=true)
     */
    protected $textBody;
    
    /**
     * The email sender email address
     * 
     * @ORM\Column(name="sender_email", type="string", length=255, nullable=true)
     */
    protected $senderEmail;
    
    /**
     * The email sender name
     * 
     * @ORM\Column(name="sender_name", type="string", length=255, nullable=true)
     */
    protected $senderName; 

    /**
     * The email locale
     * 
     * @ORM\Column(name="locale", type="string", length=10, nullable=true)
     */
    protected $locale;    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }    
    
    /**
     * Set name
     *
     * @param string $name
     * @return TransactionalEmail
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set type
     *
     * @param string $type
     * @return TransactionalEmail
     */
    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set subject
     *
     * @param string $subject
     * @return TransactionalEmail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Set htmlBody
     *
     * @param string $htmlBody
     * @return TransactionalEmail
     */
    public function setHtmlBody($htmlBody)
    {
        $this->htmlBody = $htmlBody;
        
        return $this;
    }

    /**
     * Get htmlBody
     *
     * @return string 
     */
    public function getHtmlBody()
    {
        return $this->htmlBody;
    }
    
    /**
     * Set textBody
     *
     * @param string $textBody
     * @return TransactionalEmail
     */
    public function setTextBody($textBody)
    {
        $this->textBody = $textBody;
    }

    /**
     * Get textBody
     *
     * @return string 
     */
    public function getTextBody()
    {
        return $this->textBody;
    }
    
    /**
     * Set senderEmail
     *
     * @param string $senderEmail
     * @return TransactionalEmail
     */
    public function setSenderEmail($senderEmail)
    {
        $this->senderEmail = $senderEmail;
        
        return $this;
    }

    /**
     * Get senderEmail
     *
     * @return string 
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }
    
    /**
     * Set senderName
     *
     * @param string $senderName
     * @return TransactionalEmail
     */
    public function setSenderName($senderName)
    {
        $this->senderName = $senderName;
        
        return $this;
    }

    /**
     * Get senderName
     *
     * @return string 
     */
    public function getSenderName()
    {
        return $this->senderName;
    }
    
    /**
     * Set locale
     *
     * @param string $locale
     * @return TransactionalEmail
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        
        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}
