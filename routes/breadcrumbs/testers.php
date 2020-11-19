<?php

Breadcrumbs::for('dashboard.testers.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.home');
    $breadcrumb->push(trans('testers.plural'), route('dashboard.testers.index'));
});

Breadcrumbs::for('dashboard.testers.create', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.testers.index');
    $breadcrumb->push(trans('testers.actions.create'), route('dashboard.testers.create'));
});

Breadcrumbs::for('dashboard.testers.show', function ($breadcrumb, $tester) {
    $breadcrumb->parent('dashboard.testers.index');
    $breadcrumb->push($tester->name, route('dashboard.testers.show', $tester));
});

Breadcrumbs::for('dashboard.testers.edit', function ($breadcrumb, $tester) {
    $breadcrumb->parent('dashboard.testers.show', $tester);
    $breadcrumb->push(trans('testers.actions.edit'), route('dashboard.testers.edit', $tester));
});
