<?php

namespace YOOtheme\Source\J2Store\Listener;

use YOOtheme\Builder\Source;
use YOOtheme\Source\J2Store\Type;

class LoadSourceTypes
{
    /**
     * @param Source $source
     */
    public function handle($source): void
    {
        $types = [
            [Type\J2StoreProductType::NAME, Type\J2StoreProductType::config()],
        ];

        foreach ($types as $args) {
            $source->objectType(...$args);
        }

        // $query = [];

        // foreach ($query as $args) {
        //     $source->queryType($args);
        // }
    }
}
