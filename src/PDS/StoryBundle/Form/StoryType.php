<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StoryType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('title')
            ->add('Country')
            ->add('date','date',array('widget' => 'single_text','format'=>'dd/MM/yyyy'))
//            ->add('Topics')
            ->add('meta')
            ->add('Pages', 'collection', array('type' => new PageType(),
            'allow_add' => true,
            'allow_delete' => true));
    }

    public function getName() {
        return 'story';
    }
}
