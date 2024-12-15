<?php

defined('_JEXEC') || exit();

use YOOtheme\Application;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Component\ComponentHelper;

class plgSystemYtp_source_j2store extends CMSPlugin
{
    /**
     * Use 'onAfterInitialise' event.
     */
    public function onAfterInitialise()
    {
        // Check if FOF is loaded
        if (!defined('F0F_INCLUDED')) {
            include_once JPATH_LIBRARIES . '/f0f/include.php';
        }

        if (!defined('F0F_INCLUDED') || !class_exists('F0FLess', true)) {
            return;
        }

        // Check if the j2store component is enabled
        if (!ComponentHelper::isEnabled('com_j2store', true)) {
            return;
        }

        // Check if the YOOtheme app class exists
        if (!class_exists(Application::class, false)) {
            return;
        }

        // Load module from the same directory
        $app = Application::getInstance();
        $app->load(__DIR__ . '/modules/*/bootstrap.php');
    }
}
