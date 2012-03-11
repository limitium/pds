<?php

namespace PDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RegisterType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('password','repeated', array(
            'type' => 'password',
            'invalid_message' => 'The password fields must match.',
            'options' => array('label' => 'Confirm password')
        ));

    }

    public function getName() {
        return 'pds_userbundle_usertype';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'PDS\UserBundle\Entity\User',
        );
    }

}
