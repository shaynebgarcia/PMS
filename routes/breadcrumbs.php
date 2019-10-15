<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// PAYMENT
Breadcrumbs::for('payment', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Payments', route('payment.index'));
});
    Breadcrumbs::for('payment-create', function ($trail) {
        $trail->parent('payment');
        $trail->push('Create Payment', route('payment.create'));
    });

// USER
Breadcrumbs::for('user', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('user.index'));
});
    Breadcrumbs::for('user-create', function ($trail) {
        $trail->parent('user');
        $trail->push('Create User', route('user.create'));
    });
    Breadcrumbs::for('user-show', function ($trail, $user) {
        $trail->parent('user');
        $trail->push($user->fullname, route('user.show', $user->id));
    });
    Breadcrumbs::for('user-edit', function ($trail, $user) {
        $trail->parent('user');
        $trail->push($user->fullname, route('user.edit', $user->id));
    });
// LEASE
Breadcrumbs::for('lease', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Leasing Agreements', route('lease.index'));
});
    Breadcrumbs::for('lease-create', function ($trail) {
        $trail->parent('lease');
        $trail->push('Create Leasing Agreement', route('lease.create'));
    });
    Breadcrumbs::for('lease-show', function ($trail, $property, $lease) {
        $trail->parent('lease');
        $trail->push($lease->id, route('lease.show', [$property->id, $lease->id]));
    });
        Breadcrumbs::for('lease-bill', function ($trail, $lease, $my) {
            $trail->parent('lease-show', $lease);
            $trail->push('Generate Bill', route('billing.display', [$lease->id, $my]));
        });

// TENANT
Breadcrumbs::for('tenant', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tenants', route('tenant.index'));
});
    Breadcrumbs::for('tenant-create', function ($trail) {
        $trail->parent('tenant');
        $trail->push('Create Tenant', route('tenant.create'));
    });

// PROPERTY
Breadcrumbs::for('property', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Properties', route('property.index'));
});
    Breadcrumbs::for('property-create', function ($trail) {
        $trail->parent('property');
        $trail->push('Create Property', route('property.create'));
    });
    Breadcrumbs::for('property-show', function ($trail, $property) {
        $trail->parent('property');
        $trail->push($property->name, route('property.show', $property->id));
    });
    Breadcrumbs::for('property-edit', function ($trail, $property) {
        $trail->parent('property');
        $trail->push($property->name, route('property.edit', $property->id));
    });
// UNIT
Breadcrumbs::for('unit', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Units', route('unit.index'));
});
    Breadcrumbs::for('unit-create', function ($trail, $property) {
        $trail->parent('property', $property->id);
        $trail->push('Create Unit', route('unit.create', $property->id));
    });

    Breadcrumbs::for('unit-show', function ($trail, $property, $unit) {
        $trail->parent('property-show', $unit->property);
        $trail->push($unit->number, route('unit.show', [$property->id, $unit->id]));
    });
