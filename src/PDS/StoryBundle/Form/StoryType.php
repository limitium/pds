<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StoryType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('title')
            ->add('Country')
            ->add('date')
//            ->add('Topics')
            ->add('body');
    }

    public function getName() {
        return 'story';
    }
}
