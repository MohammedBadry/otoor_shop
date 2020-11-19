<?php

Breadcrumbs::for('dashboard.currencies.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('currencies.plural'), route('dashboard.currencies.index'));
});

Breadcrumbs::for('dashboard.currencies.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.currencies.index');
    $breadcrumb->push(trans('currencies.actions.create'), route('dashboard.currencies.create'));
});

Breadcrumbs::for('dashboard.currencies.show', function ($breadcrumb, $currency) {
    $breadcrumb->parent('dashboard.currencies.index');
    $breadcrumb->push($currency->name, route('dashboard.currencies.show', $currency));
});

Breadcrumbs::for('dashboard.currencies.edit', function ($breadcrumb, $currency) {
    $breadcrumb->parent('dashboard.currencies.show', $currency);
    $breadcrumb->push(trans('currencies.actions.edit'), route('dashboard.currencies.edit', $currency));
});
