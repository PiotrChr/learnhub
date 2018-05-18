<?php
namespace LearnHub\BackendBundle\Twig;

class SplitExtension extends \Twig_Extension{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('splitF', array($this, 'splitFilter')),
        );
    }

    public function getName()
    {
        return 'app_extension';
    }

    public function splitFilter($string,$delimiter) {
        return explode($delimiter,$string);
    }
}