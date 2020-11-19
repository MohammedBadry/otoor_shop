<?php

Breadcrumbs::for('dashboard.countries.cities.edit', function ($breadcrumb, $country, $city) {
    $breadcrumb->parent('dashboard.countries.show', $country);
    $breadcrumb->push(
        trans('cities.actions.edit'),
        route('dashboard.countries.cities.edit', [$country, $city])
    );
});
