<?php
namespace  LearnHub\WebApp\WebAppBundle\Services\UrlInfo;

use LearnHub\MainApp\MainAppBundle\Entity\ScreenShot;
use LearnHub\MainApp\MainAppBundle\Model\PageScreenShotModel;
use LearnHub\WebApp\WebAppBundle\Model\UrlInfoModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface UrlInfoGrabberInterface
{
    public function fetch();
    public function getScreenShot() : ScreenShot;

}