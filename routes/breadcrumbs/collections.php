<?php

Breadcrumbs::for('dashboard.collections.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('collections.plural'), route('dashboard.collections.index'));
});

Breadcrumbs::for('dashboard.collections.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.collections.index');
    $breadcrumb->push(trans('collections.actions.create'), route('dashboard.collections.create'));
});

Breadcrumbs::for('dashboard.collections.show', function ($breadcrumb, $collection) {
    $breadcrumb->parent('dashboard.collections.index');
    $breadcrumb->push($collection->name, route('dashboard.collections.show', $collection));
});

Breadcrumbs::for('dashboard.collections.edit', function ($breadcrumb, $collection) {
    $breadcrumb->parent('dashboard.collections.show', $collection);
    $breadcrumb->push(trans('collections.actions.edit'), route('dashboard.collections.edit', $collection));
});
