<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Listener;

use YOOtheme\Builder\Source;
use ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

class LoadSourceTypes
{
    /**
     * @param Source $source
     */
    public function handle($source): void
    {
        $types = [
            [Type\ProductType::NAME, Type\ProductType::config()],
            [Type\CartItemType::NAME, Type\CartItemType::config()],
        ];

        $query = [
            Type\CartItemsQueryType::config(),
        ];

        foreach ($types as $args) {
            $source->objectType(...$args);
        }

        foreach ($query as $args) {
            $source->queryType($args);
        }
    }
}
