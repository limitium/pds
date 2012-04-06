<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StoryType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('title')
            ->add('Country')
            ->add('Time',null,array('label'=>'Decade'))
            ->add('Topics','text')
            ->add('meta',null,array('label' => 'Additional information'))
            ->add('meta_place',null,array('label' => 'Additional place'))
            ->add('meta_time',null,array('label' => 'Additional time'))
            ->add('meta_storyteller',null,array('label' => 'Storyteller information'))
            ->add('Pages', 'collection', array('type' => new PageType(),
            'allow_add' => true,
            'allow_delete' => true));
    }

    public function getName() {
        return 'story';
    }
}
