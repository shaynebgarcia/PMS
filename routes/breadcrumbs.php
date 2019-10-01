<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('user', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('user.index'));
});

Breadcrumbs::for('tenant', function ($trail) {
    $trail->parent('home');
    $trail->push('Tenants', route('tenant.index'));
});

Breadcrumbs::for('property', function ($trail) {
    $trail->parent('home');
    $trail->push('Properties', route('property.index'));
});

Breadcrumbs::for('unit', function ($trail) {
    $trail->parent('home');
    $trail->push('Units', route('unit.index'));
});


Breadcrumbs::for('payment', function ($trail) {
    $trail->parent('home');
    $trail->push('Payments', route('payment.index'));
});

Breadcrumbs::for('payment-create', function ($trail) {
    $trail->parent('payment');
    $trail->push('Create Payment', route('payment.create'));
});

Breadcrumbs::for('user-show', function ($trail, $user) {
    $trail->parent('user');
    $trail->push($user->fullname, route('user.show', $user->id));
});

Breadcrumbs::for('lease', function ($trail) {
    $trail->parent('home');
    $trail->push('Leasing Agreements', route('lease.index'));
});
    Breadcrumbs::for('lease-show', function ($trail, $lease) {
        $trail->parent('lease');
        $trail->push($lease->id, route('lease.show', $lease->id));
    });
        Breadcrumbs::for('lease-bill', function ($trail, $lease) {
            $trail->parent('lease-show', $lease);
            $trail->push('Generate Bill', route('billing.display', $lease->id));
        });

Breadcrumbs::for('tenant-create', function ($trail) {
    $trail->parent('tenant');
    $trail->push('Create Tenant', route('tenant.create'));
});

Breadcrumbs::for('property-create', function ($trail) {
    $trail->parent('property');
    $trail->push('Create Property', route('property.create'));
});

Breadcrumbs::for('property-show', function ($trail, $property) {
    $trail->parent('property');
    $trail->push($property->name, route('property.show', $property->id));
});

Breadcrumbs::for('unit-create', function ($trail, $property) {
    $trail->parent('property', $property->id);
    $trail->push('Create Unit', route('unit.create', $property->id));
});

Breadcrumbs::for('unit-show', function ($trail, $property, $unit) {
    $trail->parent('property-show', $unit->property);
    $trail->push($unit->number, route('unit.show', [$property->id, $unit->id]));
});

// // Home
// Breadcrumbs::for('home', function ($trail) {
//     $trail->push('Home', route('home'));
// });

// // Home > About
// Breadcrumbs::for('about', function ($trail) {
//     $trail->parent('home');
//     $trail->push('About', route('about'));
// });

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });