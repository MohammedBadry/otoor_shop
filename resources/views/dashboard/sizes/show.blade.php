<x-layout :title="$size->name" :breadcrumbs="['dashboard.sizes.show', $size]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('sizes.attributes.name')</th>
                        <td>{{ $size->name }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.sizes.partials.actions.edit')
                    @include('dashboard.sizes.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
