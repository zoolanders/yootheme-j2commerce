<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Listener;

use Joomla\CMS\Factory;

class InterceptJ2StoreViews
{
    public function handle($event)
    {
        // Allow for YOOtheme PRO Integration
        $app = Factory::getApplication();

        // Only in YOOtheme PRO
        if ($app->isClient('site') && stripos($app->getTemplate(), 'yootheme') === 0) {
            $controller = $event->getArguments()[0];
            $view = $controller->getThisView();

            $layout = new \ReflectionProperty($controller, 'layout');
            $layout->setAccessible(true);
            $layout->setValue($controller, 'source');

            $view->addTemplatePath(dirname(__DIR__) . '/View/');
        }
    }
}
