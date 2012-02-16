<?php

namespace PDS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('first_name','text',array('required'=>false))
            ->add('last_name','text',array('required'=>false))
            ->add('file','file',array(
                    "label" => "Userpic",
                    "required" => FALSE,
                    "attr" => array(
                        "accept" => "image/*",
                    )
                ))
            ->add('Country')
            ->add('city','text',array('required'=>false))
            ->add('institution','text',array('required'=>false))
            ->add('birth','date',array('required'=>false))
            ->add('biography')
        ;

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
