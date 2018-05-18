<?php
namespace LearnHub\BackendBundle\Services\UrlInfo;

use LearnHub\BackendBundle\Entity\ScreenShot;
use LearnHub\BackendBundle\Model\PageScreenShotModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GrabYoutubeApiData implements UrlInfoGrabberInterface {
    private $googleApiKey;
    private $url;
    private $apiUrl;
    private $query;
    private $pageInfo;

    public function __construct($url, $googleApiKey)
    {
        $this->url = $url;
        $this->id = $this->getYoutubeIdFromUrl($url);
        $this->googleApiKey = $googleApiKey;
        $this->apiUrl = 'https://www.googleapis.com/youtube/v3/videos';
        $this->query = [
            'id' => '',
            'key' => $googleApiKey,
            'part' => 'snippet',
        ];
    }

    public function fetch()
    {
        $this->setQuery('id', $this->getYoutubeIdFromUrl($this->url));

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

        $imageInfo =  $this->pageInfo['items'][0]['snippet']['thumbnails']['high'];
        $screenShot = new ScreenShot();

        $screenShot->setImageData(base64_encode(file_get_contents($imageInfo['url'])));
        $screenShot->setHeight($imageInfo['height']);
        $screenShot->setWidth($imageInfo['width']);
        $screenShot->setMime('image/jpeg');

        return $screenShot;

    }

    private function getYoutubeIdFromUrl($url) {
        preg_match('#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#', $url, $matches);
        return $matches[0];
    }
}