<x-layout :title="$category->name" :breadcrumbs="['dashboard.categories.show', $category]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('categories.attributes.name')</th>
                        <td>{{ $category->name }}</td>
                    </tr>

                    <tr>
                        <th width="200">@lang('categories.attributes.display_in_navbar')</th>
                        <td>@include('dashboard.categories.partials.flags.display_in_navbar')</td>
                    </tr>

                    <tr>
                        <th width="200">@lang('categories.attributes.description')</th>
                        <td>{!! $category->description !!}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('categories.attributes.country_id')</th>
                        <td>
                            <a href="{{ route('dashboard.countries.show', $category->country) }}"
                               class="text-decoration-none text-ellipsis">
                                {{ $category->country->name }}
                            </a>
                        </td>
                    </tr>
                    @if($image = $category->getFirstMediaUrl())
                        <tr>
                            <th width="200">@lang('categories.attributes.image')</th>
                            <td>
                                <img src="{{ $image }}"
                                     class="img img-size-64 mw-100"
                                     alt="{{ $category->name }}">
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.categories.partials.actions.edit')
                    @include('dashboard.categories.partials.actions.delete')
                @endslot
            @endcomponent
            @include('dashboard.offers.partials.list', ['target' => $category])

            @include('dashboard.categories.partials.create-box', [
                'title' => trans('categories.actions.create-subcategory'),
                'parentId' => $category->id,
            ])
        </div>
        <div class="col-md-6">
            @include('dashboard.categories.partials.list', [
                'createButton' => false,
                'title' => trans('categories.subcategories'),
                'categories' => $category->subcategories()->paginate(),
            ])
        </div>
    </div>
</x-layout>
