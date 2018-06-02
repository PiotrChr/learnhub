<?php
namespace BackendBundle\Services\UrlInfo;

use BackendBundle\Services\UrlInfo\GrabGoogleApiData;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UrlGrabberStrategy {

    private $container;

    public function __construct($url, ContainerInterface $container) {

        $this->container = $container;
        $strategy = $this->mapUrl($url);

        switch ($strategy) {
            case 'youtube':
                $this->strategy = new GrabYoutubeApiData($url, $container->getParameter('google_api_key'));
                break;
            case 'default':
                $this->strategy = new GrabGoogleApiData($url, $container->getParameter('google_api_key'));
                break;
        }
    }

    private function mapUrl($url):string {

        /**
         * @var $rx array popular sites patterns
        */
        $rx = [];

        $rx['youtube'] = '~
            ^(?:https?://)?              # Optional protocol
             (?:www\.)?                  # Optional subdomain
             (?:youtube\.com|youtu\.be)  # Mandatory domain name
             /watch\?v=([^&]+)           # URI with video id as capture group 1
             ~x';

        foreach ($rx as $name => $pattern) {
            if (preg_match($pattern, $url, $matches)) return $name;
        }

        return 'default';
    }
}
