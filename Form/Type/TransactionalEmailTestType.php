<?php

namespace YV\TransactionalEmailBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class TransactionalEmailTestType extends AbstractType
{
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
    }

    public function getName()
    {
        return 'yv_transactional_email_test';
    }
}
