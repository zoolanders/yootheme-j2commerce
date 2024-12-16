<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

use J2Store;
use J2StoreTableProduct;
use function YOOtheme\trans;

class ProductType
{
    public const NAME = 'J2StoreProduct';
    public const LABEL = 'Product';

    public static function config(): array
    {
        return [
            'fields' => [
                'id' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => trans('ID'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::id',
                    ],
                ],
                'price' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Price'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::price',
                    ],
                ],
                'price_raw' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Price (Raw)'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::rawPrice',
                    ],
                ],
                'addtocart' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Add to Cart'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::addToCart',
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => self::LABEL,
            ],
        ];
    }

    public static function id(J2StoreTableProduct $product): int
    {
        return $product->j2store_product_id;
    }

    public static function price(J2StoreTableProduct $product): string
    {
        return J2Store::product()->displayPrice($product->pricing->base_price, $product);
    }

    public static function rawPrice(J2StoreTableProduct $product): string
    {
        return $product->pricing->price;
    }

    public static function addToCart(J2StoreTableProduct $product): string
    {
        $html = $product->get_product_cart_html();

        return self::toUIkit($html);
    }

    protected static function toUIkit(string $html): string
    {
        // replace bootstrap class with UIkit
        $html = str_replace('btn btn-primary', 'uk-button uk-button-primary', $html);
        $html = str_replace('input-mini form-control', 'uk-input uk-form-small uk-form-width-xsmall', $html);

        return $html;
    }
}
