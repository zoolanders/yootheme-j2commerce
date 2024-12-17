<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Extension;

use YOOtheme\Application;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Component\ComponentHelper;

\defined('_JEXEC') or die;

final class J2Commerce extends CMSPlugin
{
    public function onAfterInitialise()
    {
        // Check if the j2store component is enabled
        if (!ComponentHelper::isEnabled('com_j2store', true)) {
            return;
        }

        // Check if FOF is loaded
        if (!defined('F0F_INCLUDED') && file_exists(JPATH_LIBRARIES . '/f0f/include.php')) {
            include_once JPATH_LIBRARIES . '/f0f/include.php';
        }

        if (!defined('F0F_INCLUDED') || !class_exists('F0FLess', true)) {
            return;
        }

        // Check if the YOOtheme app class exists
        if (!class_exists(Application::class, false)) {
            return;
        }

        // Load module from the same directory
        $app = Application::getInstance();
        $app->load(dirname(__DIR__) . '/Module/*/bootstrap.php');
    }
}
