<?php

Breadcrumbs::register('admin.navbars.index', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.dashboard');
	$breadcrumbs->push('Menus', route('admin.navbars.index'));
});

Breadcrumbs::register('admin.navbars.create', function ($breadcrumbs) {
	$breadcrumbs->parent('admin.navbars.index');
	$breadcrumbs->push('Create menu', route('admin.navbars.create'));
});

Breadcrumbs::register('admin.navbars.show', function ($breadcrumbs, $navbarid) {
	$navbar = App\Models\Menu\Menu::find($navbarid);
	$breadcrumbs->parent('admin.navbars.index');
	$breadcrumbs->push($navbar->name, route('admin.navbars.show', $navbar->id));
});

Breadcrumbs::register('admin.navbars.edit', function ($breadcrumbs, $navbar) {
	$breadcrumbs->parent('admin.navbars.show', $navbar);
	$breadcrumbs->push('Edit Menu', route('admin.navbars.edit', $navbar->id));
});