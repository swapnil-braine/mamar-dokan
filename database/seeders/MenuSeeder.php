<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Post;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Marketplace\Models\Store;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Page\Models\Page;

class MenuSeeder extends BaseSeeder
{
    use HasMenuSeeder;

    public function run(): void
    {
        $data = [
            [
                'name' => 'Main menu',
                'slug' => 'main-menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/',
                        'icon_font' => 'fi-rs-home',
                        'children' => [
                            [
                                'title' => 'Home 1',
                                'reference_id' => 1,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Home 2',
                                'reference_id' => 2,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Home 3',
                                'reference_id' => 3,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Home 4',
                                'reference_id' => 4,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Home 5',
                                'reference_id' => 16,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Home 6',
                                'reference_id' => 17,
                                'reference_type' => Page::class,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Shop',
                        'url' => '/products',
                        'children' => [
                            [
                                'title' => 'Shop Grid - Full Width',
                                'url' => '/products',
                            ],
                            [
                                'title' => 'Shop Grid - Right Sidebar',
                                'url' => '/products?layout=product-right-sidebar',
                            ],
                            [
                                'title' => 'Shop Grid - Left Sidebar',
                                'url' => '/products?layout=product-left-sidebar',
                            ],
                            [
                                'title' => 'Products Of Category',
                                'reference_id' => 1,
                                'reference_type' => ProductCategory::class,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Stores',
                        'url' => '/stores',
                        'children' => [
                            [
                                'title' => 'Stores - Grid',
                                'url' => '/stores',
                            ],
                            [
                                'title' => 'Stores - List',
                                'url' => '/stores?layout=stores-list',
                            ],
                            [
                                'title' => 'Store - Detail',
                                'url' => str_replace(url(''), '', Store::query()->find(1)->url),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Product',
                        'url' => str_replace(url(''), '', Product::query()->find(1)->url),
                        'children' => [
                            [
                                'title' => 'Product Right Sidebar',
                                'url' => str_replace(url(''), '', Product::query()->find(1)->url),
                            ],
                            [
                                'title' => 'Product Left Sidebar',
                                'url' => str_replace(url(''), '', Product::query()->find(2)->url),
                            ],
                            [
                                'title' => 'Product Full Width',
                                'url' => str_replace(url(''), '', Product::query()->find(3)->url),
                            ],
                        ],
                    ],
                    [
                        'title' => 'Blog',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                        'children' => [
                            [
                                'title' => 'Blog Grid',
                                'reference_id' => 5,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Blog List',
                                'reference_id' => 13,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Blog Big',
                                'reference_id' => 14,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Blog Wide',
                                'reference_id' => 15,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Single Post',
                                'url' => str_replace(url(''), '', Post::query()->find(1)->url),
                                'children' => [
                                    [
                                        'title' => 'Single Post Right Sidebar',
                                        'url' => str_replace(url(''), '', Post::query()->find(1)->url),
                                    ],
                                    [
                                        'title' => 'Single Post Left Sidebar',
                                        'url' => str_replace(url(''), '', Post::query()->find(2)->url),
                                    ],
                                    [
                                        'title' => 'Single Post Full Width',
                                        'url' => str_replace(url(''), '', Post::query()->find(3)->url),
                                    ],
                                    [
                                        'title' => 'Single Post with Product Listing',
                                        'url' => str_replace(url(''), '', Post::query()->find(4)->url),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 18,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Header menu',
                'slug' => 'header-menu',
                'location' => 'header-navigation',
                'items' => [
                    [
                        'title' => 'About Us',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Order Tracking',
                        'url' => '/orders/tracking',
                    ],
                ],
            ],
            [
                'name' => 'Product categories',
                'slug' => 'product-categories',
                'items' => [
                    [
                        'title' => 'Milks and Dairies',
                        'reference_id' => 1,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Clothing & beauty',
                        'reference_id' => 2,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Pet Toy',
                        'reference_id' => 3,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Baking material',
                        'reference_id' => 4,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Fresh Fruit',
                        'reference_id' => 5,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Wines & Drinks',
                        'reference_id' => 6,
                        'reference_type' => ProductCategory::class,
                    ],
                ],
            ],
            [
                'name' => 'Information',
                'slug' => 'information',
                'items' => [
                    [
                        'title' => 'Contact Us',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'About Us',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Cookie Policy',
                        'reference_id' => 8,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Terms & Conditions',
                        'reference_id' => 9,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Returns & Exchanges',
                        'reference_id' => 10,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Shipping & Delivery',
                        'reference_id' => 11,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Privacy Policy',
                        'reference_id' => 12,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Company',
                'slug' => 'company',
                'items' => [
                    [
                        'title' => 'About us',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Affiliate',
                        'url' => '#',
                    ],
                    [
                        'title' => 'Career',
                        'url' => '#',
                    ],
                    [
                        'title' => 'Contact us',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
        ];

        $this->createMenus($data);
    }
}
