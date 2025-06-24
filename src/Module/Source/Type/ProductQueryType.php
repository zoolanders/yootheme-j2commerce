<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

use function YOOtheme\trans;
use ZOOlanders\YOOtheme\J2Commerce\Module\Source\J2StoreHelper;

class ProductQueryType
{
    protected static $view = ['com_content.article'];

    public static function config(): array
    {
        return [
            'fields' => [
                'j2storeProduct' => [
                    'type' => 'J2StoreProduct',
                    'metadata' => [
                        'label' => trans('Product'),
                        'view' => static::$view,
                        'group' => trans('Page'),
                        'description' => trans('The current J2Commerce Product'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::resolve',
                    ],
                ]
            ],
        ];
    }

    public static function resolve($root)
    {
        $article = $root['article'];

        if (in_array($root['template'] ?? '', static::$view)) {
            $article = $root['article'] ?? $root['item'];
        }

        return J2StoreHelper::resolveProduct($article);
    }
}
