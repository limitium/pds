<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('message')
            ->add('Story', 'entity_id', array(
            'class' => 'PDS\StoryBundle\Entity\Story',
            'hidden' => true,
            'property' => 'id',
        ));
    }

    public function getName() {
        return 'comment';
    }
}
