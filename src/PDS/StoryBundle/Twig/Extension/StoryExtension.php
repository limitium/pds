<?php

namespace PDS\StoryBundle\Twig\Extension;

use Symfony\Component\Form\FormView;
use Symfony\Bridge\Twig\Extension\FormExtension;

class StoryExtension extends FormExtension
{

    public function __construct()
    {
        parent::__construct(array('PDSStoryBundle:Story:custom.html.twig '));
    }

    public function getFilters()
    {
        return array(
            'var_dump' => new \Twig_Filter_Function('var_dump'),
        );
    }

    public function getFunctions()
    {
        return array(
            'form_story_page' => new \Twig_Function_Method($this, 'renderStoryPage', array('is_safe' => array('html'))),
        );
    }

    public function renderStoryPage(FormView $view, array $variables = array())
    {
        return $this->render($view, 'story_page', $variables);
    }

    public function getName()
    {
        return 'story_twig_extension';
    }

}
