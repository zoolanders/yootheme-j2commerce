<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source;

use YOOtheme\Builder\BuilderConfig;

require_once(JPATH_ADMINISTRATOR . '/components/com_j2store/helpers/j2store.php');

return [

    'events' => [
        'source.init' => [
            Listener\LoadSourceTypes::class => '@handle',
            Listener\ExtendArticleType::class => ['@handle', -100],
        ],
        'builder.template' => [Listener\MatchTemplate::class => '@handle'],
        'builder.template.load' => [Listener\LoadTemplateUrl::class => '@handle'],
        BuilderConfig::class => [Listener\LoadBuilderConfig::class => '@handle'],
    ],

    'actions' => [
        'OnBeforeJ2storeControllerCartsBrowse' => [Listener\InterceptJ2StoreViews::class => '@handle']
    ]

];
