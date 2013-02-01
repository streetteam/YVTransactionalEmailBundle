<?php

namespace YV\TransactionalEmailBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class TransactionalEmailTestType extends AbstractType
{
    protected $variables;
    
    public function __construct(array $variables) 
    {
        $this->variables = $variables;
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recipient', 'email', array(
            'required' => true,
            'label' => 'Recipient email address',
            'constraints' => array(
                new Email(),
                new NotBlank()
            )
        ));
        
        foreach($this->variables as $variable) {
            $builder->add($variable, 'text', array(
                'required' => true,
                'constraints' => array(
                    new NotBlank()
                )
            ));            
        }
    }

    public function getName()
    {
        return 'yv_transactional_email_test';
    }
}
