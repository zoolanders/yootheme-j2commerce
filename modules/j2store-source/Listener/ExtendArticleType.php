<?php

namespace ZOOlanders\YOOtheme\J2Store\Listener;

use J2Store;
use YOOtheme\Builder\Source;
use ZOOlanders\YOOtheme\J2Store\Type;

class ExtendArticleType
{
    /**
     * @param Source $source
     */
    public function handle($source): void
    {
        $source->objectType('Article', [
            'fields' => [
                'j2StoreProduct' => [
                    'metadata' => [
                        'label' => Type\J2StoreProductType::LABEL,
                    ],
                    'type' => Type\J2StoreProductType::NAME,
                    'extensions' => [
                        'call' => [
                            'func' => __CLASS__ . '@resolveJ2StoreProduct',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public static function resolveJ2StoreProduct($article, $args): array
    {
        $fof = J2Store::fof();
        $productTable = $fof->loadTable('Product', 'J2StoreTable');

        $product = $productTable->get_product_by_source('com_content', $article->id);

        if (!$product) {
            return null;
        }

        return [
            'id' => $product->j2store_product_id,
        ];
    }

}
