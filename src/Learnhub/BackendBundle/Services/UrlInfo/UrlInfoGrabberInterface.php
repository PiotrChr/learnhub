<?php
namespace  LearnHub\BackendBundle\Services\UrlInfo;

use LearnHub\BackendBundle\Entity\ScreenShot;
use LearnHub\BackendBundle\Model\PageScreenShotModel;
use LearnHub\BackendBundle\Model\UrlInfoModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface UrlInfoGrabberInterface
{
    public function fetch();
    public function getScreenShot() : ScreenShot;

}