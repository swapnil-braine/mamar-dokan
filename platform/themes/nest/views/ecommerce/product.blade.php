@php
    $layout = $product->getMetaData('layout', true);

    if (! $layout) {
        $layout = theme_option('product_single_layout');
    }

    $layout = ($layout && in_array($layout, array_keys(get_product_single_layouts()))) ? $layout : 'product-right-sidebar';

    Theme::layout($layout);

    Theme::asset()->container('footer')->usePath()->add('slick-js', 'js/plugins/slick.js', ['jquery']);

    Theme::asset()->usePath()->add('magnific-popup-css', 'css/plugins/magnific-popup.css');
    Theme::asset()->container('footer')->usePath()->add('magnific-popup-js', 'js/plugins/magnific-popup.js', ['jquery']);

    Theme::asset()->usePath()->add('jquery-ui-css', 'css/plugins/jquery-ui.css');
    Theme::asset()->container('footer')->usePath()->add('jquery-ui-js', 'js/plugins/jquery-ui.js');
@endphp

<div class="product-detail accordion-detail">
    <div class="row mb-50 mt-30">
        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
            <div class="detail-gallery">
                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                <div class="product-image-slider">
                    @foreach ($productImages as $img)
                        <figure class="border-radius-10">
                            <a href="{{ RvMedia::getImageUrl($img) }}">
                                <img src="{{ RvMedia::getImageUrl($img, 'medium') }}" alt="{{ $product->name }}">
                            </a>
                        </figure>
                    @endforeach
                </div>
                <div class="slider-nav-thumbnails">
                    @foreach ($productImages as $img)
                        <div><img src="{{ RvMedia::getImageUrl($img, 'product-thumb') }}" alt="{{ $product->name }}"></div>
                    @endforeach
                </div>
            </div>
            {!! Theme::partial('social-share', ['url' => $product->url, 'description' => strip_tags(SeoHelper::getDescription())]) !!}
            <a class="mail-to-friend font-sm color-grey" href="mailto:someone@example.com?subject={{ __('Buy :name', ['name' => $product->name]) }}&body={{ __('Buy this one: :link', ['link' => $product->url]) }}"><i class="fi-rs-envelope"></i> {{ __('Email to a Friend') }}</a>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="detail-info pr-30 pl-30">
                <h2 class="title-detail">{!! BaseHelper::clean($product->name) !!}</h2>
                <div class="product-detail-rating">
                    @if (EcommerceHelper::isReviewEnabled())
                        <a href="#Reviews" data-bb-toggle="scroll-to-review">
                            <div class="product-rate-cover text-end">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted">({{ __(':count reviews', ['count' => $product->reviews_count]) }})</span>
                            </div>
                        </a>
                    @endif
                </div>

                @include(Theme::getThemeNamespace('views.ecommerce.includes.product-price-big'))

                <div class="short-desc mb-30">
                    @if (is_plugin_active('marketplace') && $product->store_id)
                        <p><span class="d-inline-block me-1">{{ __('Sold By') }}:</span> <a href="{{ $product->store->url }}"><strong>{!! BaseHelper::clean($product->store->name) !!}</strong></a></p>
                    @endif

                    {!! apply_filters('ecommerce_before_product_description', null, $product) !!}
                    {!! BaseHelper::clean($product->description) !!}
                    {!! apply_filters('ecommerce_after_product_description', null, $product) !!}
                </div>

                <form class="add-to-cart-form" method="POST" action="{{ route('public.ajax.cart.store') }}">
                    @csrf

                    @if ($product->variations()->count() > 0)
                        <div class="pr_switch_wrap">
                            {!! render_product_swatches($product, [
                                'selected' => $selectedAttrs,
                                'view' => Theme::getThemeNamespace() . '::views.ecommerce.attributes.swatches-renderer'
                            ]) !!}
                        </div>
                    @endif

                    {!! render_product_options($product) !!}

                    {!! Theme::partial('product-availability', compact('product', 'productVariation')) !!}

                    {!! apply_filters(ECOMMERCE_PRODUCT_DETAIL_EXTRA_HTML, null, $product) !!}
                    <input type="hidden" name="id" class="hidden-product-id" value="{{ ($product->is_variation || !$product->defaultVariation->product_id) ? $product->id : $product->defaultVariation->product_id }}"/>
                    <div class="detail-extralink mb-30">
                        @if (EcommerceHelper::isCartEnabled())
                            <div class="detail-qty border radius">
                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                <input type="number" min="1" value="1" name="qty" class="qty-val qty-input" />
                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                            </div>
                        @endif

                        <div class="product-extra-link2 @if (EcommerceHelper::isQuickBuyButtonEnabled()) has-buy-now-button @endif">
                            @if (EcommerceHelper::isCartEnabled())
                                <button type="submit"
                                    class="button button-add-to-cart @if ($product->isOutOfStock()) btn-disabled @endif"
                                    @if ($product->isOutOfStock()) disabled @endif><i class="fi-rs-shopping-cart"></i>{{ __('Add to cart') }}</button>
                                @if (EcommerceHelper::isQuickBuyButtonEnabled())
                                    <button class="button button-buy-now ms-2 @if ($product->isOutOfStock()) btn-disabled @endif"
                                        type="submit" name="checkout"
                                        @if ($product->isOutOfStock()) disabled @endif>{{ __('Buy Now') }}</button>
                                @endif
                            @endif

                            @if (EcommerceHelper::isWishlistEnabled())
                                <a aria-label="{{ __('Add To Wishlist') }}" class="action-btn hover-up js-add-to-wishlist-button" data-url="{{ route('public.wishlist.add', $product->id) }}" href="#"><i class="fi-rs-heart"></i></a>
                            @endif
                            @if (EcommerceHelper::isCompareEnabled())
                                <a aria-label="{{ __('Add To Compare') }}" href="#" class="action-btn hover-up js-add-to-compare-button" data-url="{{ route('public.compare.add', $product->id) }}"><i class="fi-rs-shuffle"></i></a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="font-xs">

                    <ul class="mr-50 float-start">

                        <li class="mb-5 @if (! $product->sku) d-none @endif" id="product-sku">
                            <span class="d-inline-block me-1">{{ __('SKU') }}:</span> <span class="sku-text">{{ $product->sku }}</span>
                        </li>

                        @if ($product->categories->isNotEmpty())
                            <li class="mb-5">
                                <span class="d-inline-block me-1">{{ __('Categories') }}:</span>
                                @foreach($product->categories as $category)
                                    <a href="{{ $category->url }}" title="{{ $category->name }}">{!! BaseHelper::clean($category->name) !!}</a>@if (!$loop->last),@endif
                                @endforeach
                            </li>
                        @endif
                        @if ($product->tags->isNotEmpty())
                            <li class="mb-5">
                                <span class="d-inline-block me-1">{{ __('Tags') }}:</span>
                                @foreach($product->tags as $tag)
                                    <a href="{{ $tag->url }}" rel="tag" title="{{ $tag->name }}">{{ $tag->name }}</a>@if (!$loop->last),@endif
                                @endforeach
                            </li>
                        @endif

                        @if ($product->brand->id)
                            <li class="mb-5">
                                <span class="d-inline-block me-1">{{ __('Brands') }}:</span>
                                <a href="{{ $product->brand->url }}" title="{{ $product->brand->name }}">{{ $product->brand->name }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product-info">
        <div class="tab-style3">
            <ul class="nav nav-tabs text-uppercase">
                <li class="nav-item">
                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">{{ __('Description') }}</a>
                </li>
                @if (EcommerceHelper::isProductSpecificationEnabled() && $product->specificationAttributes->where('pivot.hidden', false)->isNotEmpty())
                    <li class="nav-item">
                        <a class="nav-link" id="specification-tab" data-bs-toggle="tab" href="#tab-specification">{{ __('Specification') }}</a>
                    </li>
                @endif
                @if (EcommerceHelper::isReviewEnabled())
                    <li class="nav-item">
                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">{{ __('Reviews') }} ({{ $product->reviews_count }})</a>
                    </li>
                @endif

                @if (is_plugin_active('marketplace') && $product->store_id)
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab-vendor">{{ __('Vendor') }}</a>
                    </li>
                @endif

                @if (is_plugin_active('faq'))
                    @if (count($product->faq_items) > 0)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-faq">{{ __('Questions and Answers') }}</a>
                        </li>
                    @endif
                @endif
            </ul>
            <div class="tab-content shop_info_tab entry-main-content">
                <div class="tab-pane fade show active" id="Description">
                    <div class="ck-content">
                        {!! BaseHelper::clean($product->content) !!}
                    </div>
                    {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $product) !!}
                </div>

                @if (EcommerceHelper::isProductSpecificationEnabled() && $product->specificationAttributes->where('pivot.hidden', false)->isNotEmpty())
                    <div class="tab-pane fade" id="tab-specification">
                        <div class="tp-product-details-additional-info">
                            @include(EcommerceHelper::viewPath('includes.product-specification'))
                        </div>
                    </div>
                @endif

                @if (is_plugin_active('marketplace') && $product->store_id && $product->store->id)
                    <div class="tab-pane fade" id="tab-vendor">
                        <div class="vendor-logo d-flex mb-30">
                            <img src="{{ RvMedia::getImageUrl($product->store->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $product->store->name }}" />
                            <div class="vendor-name ml-15">
                                <p class="font-heading h6">
                                    <a href="{{ $product->store->url }}">{!! BaseHelper::clean($product->store->name) !!}</a>
                                </p>
                                @php
                                    $reviews = $product->store
                                        ->reviews()
                                        ->select([DB::raw('avg(star) as reviews_avg, count(star) as reviews_count')])
                                        ->first();
                                @endphp
                                @if ($reviews->reviews_count)
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: {{ $reviews->reviews_avg * 20 }}%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{ __(':count reviews', ['count' => $reviews->reviews_count]) }})</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <ul class="contact-infor mb-50">
                            @if (! MarketplaceHelper::hideStoreAddress() && $product->store->full_address)
                                <li>
                                    <img src="{{ Theme::asset()->url('imgs/theme/icons/icon-location.svg') }}" alt="{{ __('Address') }}" />
                                    <strong>{{ __('Address') }}: </strong>
                                    <span>{{ $product->store->full_address }}</span>
                                </li>
                            @endif
                            @if (!MarketplaceHelper::hideStorePhoneNumber() && $product->store->phone)
                                <li>
                                    <img src="{{ Theme::asset()->url('/imgs/theme/icons/icon-contact.svg') }}" alt="{{ __('Contact Seller') }}" />
                                    <strong>{{ __('Contact Seller') }}: </strong>
                                    <span>{{ $product->store->phone }}</span>
                                </li>
                            @endif
                        </ul>
                        <div>
                            {!! BaseHelper::clean($product->store->content) !!}
                        </div>
                    </div>
                @endif

                @if (is_plugin_active('faq') && count($product->faq_items) > 0)
                    <div class="tab-pane fade faqs-list" id="tab-faq">
                        <div class="accordion" id="faq-accordion">
                            @foreach($product->faq_items as $faq)
                                <div class="card">
                                    <div class="card-header" id="heading-faq-{{ $loop->index }}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left @if (!$loop->first) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-{{ $loop->index }}" aria-expanded="true" aria-controls="collapse-faq-{{ $loop->index }}">
                                                {!! BaseHelper::clean($faq[0]['value']) !!}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse-faq-{{ $loop->index }}" class="collapse @if ($loop->first) show @endif" aria-labelledby="heading-faq-{{ $loop->index }}" data-parent="#faq-accordion">
                                        <div class="card-body">
                                            {!! BaseHelper::clean($faq[1]['value']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (EcommerceHelper::isReviewEnabled())
                    <div class="tab-pane fade" id="Reviews">
                        @include('plugins/ecommerce::themes.includes.reviews')
                    </div>
                @endif
            </div>
        </div>
    </div>
    @php
        $crossSellProducts = get_cross_sale_products($product);
    @endphp
    @if ($crossSellProducts->isNotEmpty())
        <div class="mt-60">
            <h3 class="section-title style-1 mb-30">{{ __('You may also like') }}</h3>

            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-items-loop', ['products' => $crossSellProducts, 'perRow' => 4])
        </div>
    @endif

    @php
        $relatedProducts = get_related_products($product);
    @endphp
    @if ($relatedProducts->isNotEmpty())
        <div class="mt-60">
            <h3 class="section-title style-1 mb-30">{{ __('Related products') }}</h3>

            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.product-items-loop', ['products' => $relatedProducts, 'perRow' => 4])
        </div>
    @endif
</div>
