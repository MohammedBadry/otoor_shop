<?php

Breadcrumbs::for('dashboard.pages.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('pages.plural'), route('dashboard.pages.index'));
});

Breadcrumbs::for('dashboard.pages.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.pages.index');
    $breadcrumb->push(trans('pages.actions.create'), route('dashboard.pages.create'));
});

Breadcrumbs::for('dashboard.pages.show', function ($breadcrumb, $page) {
    $breadcrumb->parent('dashboard.pages.index');
    $breadcrumb->push($page->name, route('dashboard.pages.show', $page));
});

Breadcrumbs::for('dashboard.pages.edit', function ($breadcrumb, $page) {
    $breadcrumb->parent('dashboard.pages.show', $page);
    $breadcrumb->push(trans('pages.actions.edit'), route('dashboard.pages.edit', $page));
});
