<?php

Breadcrumbs::for('dashboard.sizes.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('sizes.plural'), route('dashboard.sizes.index'));
});

Breadcrumbs::for('dashboard.sizes.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.sizes.index');
    $breadcrumb->push(trans('sizes.actions.create'), route('dashboard.sizes.create'));
});

Breadcrumbs::for('dashboard.sizes.show', function ($breadcrumb, $size) {
    $breadcrumb->parent('dashboard.sizes.index');
    $breadcrumb->push($size->name, route('dashboard.sizes.show', $size));
});

Breadcrumbs::for('dashboard.sizes.edit', function ($breadcrumb, $size) {
    $breadcrumb->parent('dashboard.sizes.show', $size);
    $breadcrumb->push(trans('sizes.actions.edit'), route('dashboard.sizes.edit', $size));
});
