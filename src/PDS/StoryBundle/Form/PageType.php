<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('body')
            ->add('lineno')
            ->add('Story')
        ;
    }

    public function getName()
    {
        return 'pds_storybundle_pagetype';
    }
}
