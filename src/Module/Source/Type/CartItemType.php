<?php

namespace ZOOlanders\YOOtheme\J2Commerce\Module\Source\Type;

use J2Store;
use J2StoreTableProduct;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\Component\Content\Site\Model\ArticleModel;
use function YOOtheme\trans;

class CartItemType
{
    public const NAME = 'J2StoreCartItem';
    public const LABEL = 'Cart Item';

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
                'sku' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('SKU'),
                    ],
                ],
                'name' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Name'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::name',
                    ],
                ],
                'price' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => trans('Price'),
                    ],
                ],
                'quantity' => [
                    'type' => 'Int',
                    'metadata' => [
                        'label' => trans('Quantity'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::quantity',
                    ],
                ],
                'link' => [
                    'type' => 'String',
                    'metadata' => [
                        'label' => trans('Link'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::link',
                    ],
                ],
                'product' => [
                    'type' => ProductType::NAME,
                    'metadata' => [
                        'label' => ProductType::LABEL
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::product',
                    ],
                ],
                'article' => [
                    'type' => 'Article',
                    'metadata' => [
                        'label' => trans('Article'),
                    ],
                    'extensions' => [
                        'call' => __CLASS__ . '::article',
                    ],
                ],
            ],

            'metadata' => [
                'type' => true,
                'label' => self::LABEL,
            ],
        ];
    }

    public static function id(object $item): int
    {
        return $item->j2store_cartitem_id;
    }

    public static function quantity(object $item): int
    {
        return $item->product_qty;
    }

    public static function name(object $item): string
    {
        return $item->product_name;
    }

    public static function link(object $item): string
    {
        return $item->product_view_url;
    }

    public static function product(object $item): J2StoreTableProduct
    {
        $table = J2Store::fof()->loadTable('Product', 'J2StoreTable');

        return $table->get_product_by_id($item->product_id);
    }

    public static function article(object $item)
    {
        $model = new ArticleModel(['ignore_request' => true]);
        $model->setState('params', ComponentHelper::getParams('com_content'));

        return $model->getItem($item->product_source_id);
    }
}
