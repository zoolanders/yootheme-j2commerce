<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source;

require_once(JPATH_ADMINISTRATOR . '/components/com_j2store/helpers/j2store.php');

return [

    'events' => [
        'source.init' => [
            Listener\LoadSourceTypes::class => '@handle',
            Listener\ExtendArticleType::class => ['@handle', -100],
        ]
    ]

];
