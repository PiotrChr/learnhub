<?php
namespace LearnHub\WebApp\WebAppBundle\EventListener;

// ...

use LearnHub\WebApp\WebAppBundle\Model\MenuItemModel;
use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class SideMenuItemListListener {

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onSetupMenu(SidebarMenuEvent $event) {

        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }

    }

    protected function getMenu(Request $request) {
        // Build your menu here by constructing a MenuItemModel array
        $menuItems = array(
            new MenuItemModel('label_main','Main nav',false),
            $home = new MenuItemModel('sideMenu_home', 'Home', 'web_app_homepage', array(/* options */), 'fa fa-home'),
            $hub = new MenuItemModel('sideMenu_hub', 'Hub', 'web_app_hub', array(/* options */), 'fa fa-graduation-cap'),

        );

        // Add security menu items
        $security = $this->container->get('security.authorization_checker');
        if ($security->isGranted('IS_AUTHENTICATED_REMEMBERED') OR $security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $securityItems = [
                new MenuItemModel('label_login','Login',false),
                new MenuItemModel('sideMenu_profile','Profile','web_app_profile',[],'fa fa-user'),
                new MenuItemModel('sideMenu_signout','Sign Out','web_app_signout',array(),'fa fa-sign-out')
            ];
        } else {
            $securityItems = [
                new MenuItemModel('label_login','Login',false),
                new MenuItemModel('sideMenu_signin','Sign In','web_app_signin',[],'fa fa-sign-in'),
                new MenuItemModel('sideMenu_signup','Sign Up','web_app_signup',array(),'fa fa-user-plus')
            ];
        }
        $menuItems = array_merge($menuItems,$securityItems);


        $hub->addChild(new MenuItemModel('sideMenu_hub_home', 'Headquarters', 'web_app_hub',[], 'fa fa-heartbeat'));
        $hub->addChild(new MenuItemModel('sideMenu_hub_new', 'Add a resource', 'web_app_hub.addSource',[], 'fa fa-plus'));
        $hub->addChild(new MenuItemModel('sideMenu_hub_new', 'New resources', 'web_app_hub.repository.new',[], 'fa fa-star-o'));
        $hub->addChild(new MenuItemModel('sideMenu_hub_new', 'Categories', 'web_app_hub.categories',[], 'fa fa-sitemap'));

        return $this->activateByRoute($request->get('_route'), $menuItems);
    }

    protected function activateByRoute($route, $items) {

        foreach($items as $item) {
            if($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            }
            else {
                if($item->getRoute() == $route) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }

}