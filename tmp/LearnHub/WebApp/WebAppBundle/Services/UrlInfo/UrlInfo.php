<?php
namespace LearnHub\WebApp\WebAppBundle\Services\UrlInfo;

use LearnHub\WebApp\WebAppBundle\Model\UrlInfoModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UrlInfo {

    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function init($url, $options = [])
    {
        $strategy = new UrlGrabberStrategy($url,$this->container);
        return $strategy->strategy;
    }


}