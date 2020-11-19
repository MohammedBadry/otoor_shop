<x-layout :title="Str::limit($product->name, 50)" :breadcrumbs="['dashboard.products.show', $product]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('products.attributes.name')</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('products.attributes.category_id')</th>
                        <td>
                            @foreach($product->categories as $category)
                                {{ $category->name }}
                                @if(! $loop->last)
                                    <span class="mr-2">/</span>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    @if($product->brand)
                        <tr>
                            <th width="200">@lang('products.attributes.brand_id')</th>
                            <td>{{ $product->brand->name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th width="200">@lang('products.attributes.old_price')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($product->price) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('products.attributes.discount')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($product->getDiscount()) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('products.attributes.price')</th>
                        <td>
                            <strong class="text-success">{{ price($product->getPrice()) }}</strong>
                        </td>
                    </tr>
                    @foreach($product->sizes as $size)
                        <tr>
                            <th width="200">{{ $size->name }}</th>
                            <td>
                                <strong class="text-success">{{ price($size->price) }}</strong>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th width="200">@lang('products.attributes.percent')</th>
                        <td>
                            <strong class="badge badge-danger">{{ $product->getDiscountPercent() }}%</strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('products.attributes.meta_description')</th>
                        <td>
                            {{ $product->meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('products.attributes.meta_keywords')</th>
                        <td>
                            @foreach(explode(',', $product->meta_keywords) as $keyword)
                                <span class="badge badge-dark">{{ $keyword }}</span>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.products.partials.actions.edit')
                    @include('dashboard.products.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            <div class="slider">
                <div class="preview">
                    <img src="{{ $product->getFirstMediaUrl('default', 'large') }}" alt="{{ $product->name }}">
                </div>
                <ul class="items">
                    @foreach($product->getMedia('default') as $media)
                        <li class="{{ $loop->first ? 'active' : ''  }}" data-src="{{ $media->getFullUrl() }}">
                            <img src="{{ $media->getFullUrl() }}" alt="{{ $media->name }}">
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    @component('dashboard::components.box')
        @slot('title', trans('products.attributes.description'))
        {!! $product->description !!}
    @endcomponent
    @include('dashboard.offers.partials.list', ['target' => $product])
</x-layout>

