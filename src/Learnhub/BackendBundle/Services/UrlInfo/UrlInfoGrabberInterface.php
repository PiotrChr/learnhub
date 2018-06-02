<?php
namespace  BackendBundle\Services\UrlInfo;

use BackendBundle\Entity\ScreenShot;
use BackendBundle\Model\PageScreenShotModel;
use BackendBundle\Model\UrlInfoModel;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface UrlInfoGrabberInterface
{
    public function fetch();
    public function getScreenShot() : ScreenShot;

}
