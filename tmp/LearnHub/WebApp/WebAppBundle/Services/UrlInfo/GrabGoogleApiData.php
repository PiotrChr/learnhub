<?php
namespace LearnHub\WebApp\WebAppBundle\Services\UrlInfo;

use LearnHub\MainApp\MainAppBundle\Entity\ScreenShot;
use LearnHub\MainApp\MainAppBundle\Model\PageScreenShotModel as PageScreenShot;
use LearnHub\WebApp\WebAppBundle\Services\UrlInfo\UrlInfoGrabberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GrabGoogleApiData implements UrlInfoGrabberInterface {

    private $apiUrl;
    private $query = [];
    private $googleApiKey;
    private $url;
    private $pageInfo;

    public function __construct($url, $googleApiKey)
    {
        $this->url = $url;
        $this->googleApiKey = $googleApiKey;
        $this->apiUrl = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed';
        $this->query = [
            'url' => '',
            'screenshot' => 'true',
            'key' => $googleApiKey
        ];
    }

    public function fetch() {
        $this->setQuery('url', $this->url);

        $pageInfo = file_get_contents($this->getFullUrl());
        $pageInfo = json_decode($pageInfo, true);

        $this->pageInfo = $pageInfo;

    }

    public function setQuery($key, $value) {
        $this->query[$key] = $value;
    }

    public function getFullUrl() {
        return $this->apiUrl.'?'.urldecode(http_build_query($this->query));
    }

    private function convertBase64($base64) {
        return str_replace(['_','-'],['/','+'],$base64);
    }

    public function getScreenShot() : ScreenShot
    {
        if (!$this->pageInfo) $this->fetch();
        $screenShot = new ScreenShot();

        $screenShot->setImageData($this->convertBase64($this->pageInfo['screenshot']['data']));
        $screenShot->setHeight($this->pageInfo['screenshot']['height']);
        $screenShot->setWidth($this->pageInfo['screenshot']['width']);
        $screenShot->setMime($this->pageInfo['screenshot']['mime_type']);

        return $screenShot;
    }


}