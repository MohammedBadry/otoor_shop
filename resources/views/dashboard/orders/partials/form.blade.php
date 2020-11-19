@include('dashboard.errors')
{{ BsForm::select('status')->options(trans('orders.statuses')) }}
