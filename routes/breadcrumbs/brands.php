<?php

Breadcrumbs::for('dashboard.brands.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('brands.plural'), route('dashboard.brands.index'));
});

Breadcrumbs::for('dashboard.brands.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.brands.index');
    $breadcrumb->push(trans('brands.actions.create'), route('dashboard.brands.create'));
});

Breadcrumbs::for('dashboard.brands.show', function ($breadcrumb, $brand) {
    $breadcrumb->parent('dashboard.brands.index');
    $breadcrumb->push($brand->name, route('dashboard.brands.show', $brand));
});

Breadcrumbs::for('dashboard.brands.edit', function ($breadcrumb, $brand) {
    $breadcrumb->parent('dashboard.brands.show', $brand);
    $breadcrumb->push(trans('brands.actions.edit'), route('dashboard.brands.edit', $brand));
});
