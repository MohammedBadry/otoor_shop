<x-layout :title="$brand->name" :breadcrumbs="['dashboard.brands.show', $brand]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('brands.attributes.name')</th>
                        <td>{{ $brand->name }}</td>
                    </tr>
                    <tr>
                      <th width="200">@lang('brands.attributes.image')</th>
                      <td>
                        <img src="{{ $brand->getFirstMediaUrl() }}"
                             class="img img-size-64 mw-100"
                             alt="{{ $brand->name }}">
                      </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.brands.partials.actions.edit')
                    @include('dashboard.brands.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
