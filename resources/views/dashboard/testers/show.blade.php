<x-layout :title="$tester->name" :breadcrumbs="['dashboard.testers.show', $tester]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('testers.attributes.name')</th>
                        <td>{{ $tester->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('testers.attributes.old_price')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($tester->price) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('testers.attributes.discount')</th>
                        <td>
                            <strong class="text-danger"><s>{{ price($tester->getDiscount()) }}</s></strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('testers.attributes.price')</th>
                        <td>
                            <strong class="text-success">{{ price($tester->getPrice()) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th width="200">@lang('testers.attributes.percent')</th>
                        <td>
                            <strong class="badge badge-danger">{{ $tester->getDiscountPercent() }}%</strong>
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.testers.partials.actions.edit')
                    @include('dashboard.testers.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            <div class="slider">
                <div class="preview">
                    <img src="{{ $tester->getFirstMediaUrl('default', 'large') }}" alt="{{ $tester->name }}">
                </div>
                <ul class="items">
                    @foreach($tester->getMedia('default') as $media)
                        <li class="{{ $loop->first ? 'active' : ''  }}" data-src="{{ $media->getFullUrl('large') }}">
                            <img src="{{ $media->getFullUrl('thumb') }}" alt="{{ $media->name }}">
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
    @include('dashboard.products.partials.list', [
        'products' => $tester->products()->paginate(),
        'filter' => false,
        'title' => trans('products.plural'),
        'createButton' => false,
        'controls' => false,
    ])
    @include('dashboard.offers.partials.list', ['target' => $tester])
</x-layout>
