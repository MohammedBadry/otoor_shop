<x-layout :title="$collection->name" :breadcrumbs="['dashboard.collections.show', $collection]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('collections.attributes.name')</th>
                        <td>{{ $collection->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('collections.attributes.old_price')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($collection->price) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('collections.attributes.discount')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($collection->getDiscount()) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('collections.attributes.price')</th>
                        <td>
                            <strong class="text-success">{{ price($collection->getPrice()) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('collections.attributes.percent')</th>
                        <td>
                            <strong class="badge badge-danger">{{ $collection->getDiscountPercent() }}%</strong>
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.collections.partials.actions.edit')
                    @include('dashboard.collections.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            <div class="slider">
                <div class="preview">
                    <img src="{{ $collection->getFirstMediaUrl('default', 'large') }}" alt="{{ $collection->name }}">
                </div>
                <ul class="items">
                    @foreach($collection->getMedia('default') as $media)
                        <li class="{{ $loop->first ? 'active' : ''  }}" data-src="{{ $media->getFullUrl('large') }}">
                            <img src="{{ $media->getFullUrl('thumb') }}" alt="{{ $media->name }}">
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    @include('dashboard.products.partials.list', [
        'products' => $collection->products()->paginate(),
        'filter' => false,
        'title' => trans('products.plural'),
        'createButton' => false,
        'controls' => false,
    ])
    @include('dashboard.offers.partials.list', ['target' => $collection])
</x-layout>
