<?php
// Allow for YOOtheme PRO Integration
$app = \Joomla\CMS\Factory::getApplication();

// Trigger the custom YOOtheme Pro event
$app->triggerEvent('onLoadTemplate', [$this, 'source']);

echo $this->_output;
