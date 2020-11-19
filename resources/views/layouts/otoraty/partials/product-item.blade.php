<div class="products__box">
    <div class="img">
        <img src="{{ $product->getFirstMediaUrl() }}"
             alt="{{ $product->name }}" style="height: 150px;object-fit: contain;">
    </div>
    <div class="product__box--details">
        <a href="{{ $product->getWebUrl() }}" title="{{ $product->name }}">
            {{ Str::limit($product->name, 20) }}
        </a>
        @if($product->getDiscountPercent())
            <span class="badge badge-danger"><s>{{ $product->getDiscountPercent() }}%</s></span>
        @endif
        <h4 class="product__price">{{ price($product->getPrice()) }}</h4>
    </div>
    <div class="product__box--bottom d-flex justify-content-between">
        <input type="hidden" form="product-cart-form-{{ $product->getMorphClass() }}-{{ $product->id }}" name="product_id" value="{{ $product->id }}"/>
        <div class="counter__product">
            <button type="button" class="sub btn">-</button>
            <input type="number" form="product-cart-form-{{ $product->getMorphClass() }}-{{ $product->id }}" name="qty" class="qty" value="1" min="1"
                   max="3"/>
            <button type="button" class="add btn">+</button>
        </div>
        <button form="product-cart-form-{{ $product->getMorphClass() }}-{{ $product->id }}" class="btn btn__cart" type="submit">@lang('Add to cart') <i
                    class="fas fa-cart-plus"></i></button>
        {{ BsForm::post(LaravelLocalization::localizeURL(url('/cart')), ['id' => 'product-cart-form-'.$product->getMorphClass().'-'.$product->id]) }}

        {{ Form::hidden('item_id', $product->id) }}
        {{ Form::hidden('item_type', $product->getMorphClass()) }}

        {{ BsForm::close() }}
    </div>
    <div class="product__box--top d-flex justify-content-between align-items-center">
        {{--        <div class="stars d-flex">--}}
        {{--            <span><i class="far fa-star"></i></span>--}}
        {{--            <span><i class="fas fa-star"></i></span>--}}
        {{--            <span><i class="fas fa-star"></i></span>--}}
        {{--            <span><i class="fas fa-star"></i></span>--}}
        {{--            <span><i class="fas fa-star"></i></span>--}}
        {{--        </div>--}}
        @can('addToFavorite', $product)
            {{ BsForm::post(LaravelLocalization::localizeURL(route('products.favorites.add', $product))) }}
            <button class="btn" type="submit" title="@lang('products.actions.add-to-favorite')">
                <i class="far fa-heart"></i>
            </button>
            {{ BsForm::close() }}
        @endcan
        @can('removeFromFavorite', $product)
            {{ BsForm::delete(LaravelLocalization::localizeURL(route('products.favorites.remove', $product))) }}
            <button class="btn" type="submit" title="@lang('products.actions.remove-from-favorite')">
                <i class="fas fa-heart"></i>
            </button>
            {{ BsForm::close() }}
        @endcan
    </div>
</div>