<x-layout :title="$country->name" :breadcrumbs="['dashboard.countries.show', $country]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('countries.attributes.name')</th>
                        <td>{{ $country->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries.attributes.currency')</th>
                        <td>{{ $country->currency }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries.attributes.code')</th>
                        <td>{{ $country->code }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries.attributes.key')</th>
                        <td>{{ $country->key }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries.attributes.is_default')</th>
                        <td>@include('dashboard.countries.partials.flags.default')</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('countries.attributes.flag')</th>
                        <td>
                            <img src="{{ $country->getFirstMediaUrl('flags') }}"
                                 class="img img-size-64"
                                 alt="{{ $country->name }}">
                        </td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.countries.partials.actions.edit')
                    @include('dashboard.countries.partials.actions.delete')
                @endslot
            @endcomponent

            @include('dashboard.cities.create', ['countryId' => $country->id])
        </div>
        <div class="col-md-6">
            @include('dashboard.cities.index')
        </div>
    </div>
</x-layout>
