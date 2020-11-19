@include('dashboard.errors')
{{ BsForm::text('address') }}
<select2 name="city_id"
         label="@lang('cities.singular')"
         remote-url="{{ route('cities.select', ['selected_id' => $cityId = $address->city_id ?? old('city_id')]) }}"
         value="{{ $cityId }}"
></select2>
