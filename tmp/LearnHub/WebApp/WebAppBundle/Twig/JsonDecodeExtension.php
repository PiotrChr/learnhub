<?php
namespace LearnHub\WebApp\WebAppBundle\Twig;

class JsonDecodeExtension extends \Twig_Extension {
    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function getFilters() {
        return [
            new \Twig_SimpleFilter('json_decode', array($this, 'jsonDecode')),
        ];
    }

    public function jsonDecode($string) {
        return json_decode($string, true);
    }
}