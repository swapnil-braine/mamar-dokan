@if (is_plugin_active('ecommerce'))
    @php
        $products = get_trending_products([
            'take'      => (int) $config['number_display'] ?: 4,
            'with'      => ['slugable'],
        ] + EcommerceHelper::withReviewsParams());
    @endphp
    @if ($products->isNotEmpty())
        <div class="sidebar-widget product-sidebar mb-50 p-30 bg-grey border-radius-10">
            <h5 class="section-title style-1 mb-30">{{ $config['name'] }}</h5>
            @foreach ($products as $product)
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="{{ RvMedia::getImageUrl($product->image, 'product-thumb', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="content pt-10">
                        <h5><a href="{{ $product->url }}">{!! BaseHelper::clean($product->name) !!}</a></h5>
                        <div class="price mb-0 mt-5">
                            @include(Theme::getThemeNamespace('views.ecommerce.includes.product-price'))
                        </div>
                        {!! Theme::partial('rating-item', ['ratingCount' => $product->reviews_count, 'ratingAvg' => $product->reviews_avg]) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endif
