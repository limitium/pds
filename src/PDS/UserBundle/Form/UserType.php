<?php

namespace PDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('password', 'password');
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
