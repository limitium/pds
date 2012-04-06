<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('body','textarea',array('required'=>false))
            ->add('lineno','hidden')
            ->add('Story', 'entity_id', array(
            'class' => 'PDS\StoryBundle\Entity\Story',
            'hidden' => true,
            'property' => 'id',
        ))
        ;
    }

    public function getName()
    {
        return 'pds_storybundle_pagetype';
    }
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'PDS\StoryBundle\Entity\Page',
        );
    }

}
