<?php

namespace YV\TransactionalEmailBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class TransactionalEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'required' => false,
            'label' => 'Email name',
        ));
        $builder->add('type', 'text', array(
            'required' => true,
            'label' => 'Email type',
            'constraints' => new NotBlank()
        ));
        $builder->add('subject', 'text', array(
            'required' => true,
            'label' => 'Email default subject',
            'constraints' => new NotBlank()
        ));
        $builder->add('htmlBody', 'textarea', array(
            'required' => false,
            'label' => 'Email HTML body'
        )); 
        $builder->add('textBody', 'textarea', array(
            'required' => false,
            'label' => 'Email text body'
        ));
        $builder->add('senderEmail', 'email', array(
            'required' => false,
            'label' => 'Sender email address'
        ));       
        $builder->add('senderName', 'text', array(
            'required' => false,
            'label' => 'Sender name'
        ));          
    }

    public function getName()
    {
        return 'yv_transactional_email';
    }
}
