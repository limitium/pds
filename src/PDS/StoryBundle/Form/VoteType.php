<?php

namespace PDS\StoryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VoteType extends AbstractType {
    public function buildForm(FormBuilder $builder, array $options) {
        $builder
            ->add('value','hidden')
            ->add('Story', 'entity_id', array(
            'class' => 'PDS\StoryBundle\Entity\Story',
            'hidden' => true,
            'property' => 'id',
            'required' => 'true'
        ));
    }

    public function getName() {
        return 'vote';
    }
}
