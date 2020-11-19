<x-layout :title="$page->name" :breadcrumbs="['dashboard.pages.show', $page]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('pages.attributes.name')</th>
                        <td>{{ $page->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('pages.attributes.description')</th>
                        <td>{!! $page->description !!}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.pages.partials.actions.edit')
                    @include('dashboard.pages.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
    </div>
</x-layout>
