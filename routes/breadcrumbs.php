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

// TENANT
Breadcrumbs::for('tenant', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tenants', route('tenant.index'));
});
    Breadcrumbs::for('tenant-create', function ($trail) {
        $trail->parent('tenant');
        $trail->push('Create Tenant', route('tenant.create'));
    });
    Breadcrumbs::for('tenant-show', function ($trail, $tenant) {
        $trail->parent('tenant');
        $trail->push($tenant->user->fullnamewm, route('tenant.show', $tenant->user->slug));
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
        $trail->parent('property-show', $property);
        $trail->push('Create Unit', route('unit.create', $property->id));
    });
    Breadcrumbs::for('unit-edit', function ($trail, $property, $unit) {
        $trail->parent('property-show', $property);
        $trail->push($unit->number, route('unit.edit', [$property->id, $unit->id]));
    });
        Breadcrumbs::for('unit-type-create', function ($trail, $property) {
            $trail->parent('property-show', $property);
            $trail->push('Create Unit Type', route('unit-type.create', $property->id));
        });
        Breadcrumbs::for('unit-type-edit', function ($trail, $property, $unitType) {
            $trail->parent('property-show', $property);
            $trail->push($unitType->name, route('unit-type.edit', [$property->id, $unitType->id]));
        });
    Breadcrumbs::for('unit-show', function ($trail, $property, $unit) {
        $trail->parent('property-show', $unit->property);
        $trail->push($unit->number, route('unit.show', [$property->id, $unit->id]));
    });
    Breadcrumbs::for('bill', function ($trail, $property) {
        $trail->parent('property-show', $property);
        $trail->push('Billing Invoices', route('billing.index', $property->id));
    });
// LEASE
Breadcrumbs::for('lease', function ($trail, $property) {
    $trail->parent('property-show', $property);
    $trail->push('Leasing Agreements', route('lease.index', $property->id));
});
    Breadcrumbs::for('lease-create', function ($trail, $property) {
        $trail->parent('lease', $property);
        $trail->push('Create Leasing Agreement', route('lease.create', $property->id));
    });
    Breadcrumbs::for('lease-renew', function ($trail, $property, $lease) {
        $trail->parent('lease');
        $trail->push($lease->agreement_no, route('lease.renewform', [$property->id, $lease->id]));
    });
    Breadcrumbs::for('lease-show', function ($trail, $property, $link) {
        $trail->parent('lease', $property, $link);
        $trail->push($link->link_id);
    });

    Breadcrumbs::for('lease-detail-show', function ($trail, $property, $link, $lease) {
        $trail->parent('lease-show', $property, $link, $lease);
        $trail->push($lease->agreement_no);
    });

        Breadcrumbs::for('lease-bill', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Billing', route('billing.group.lease', [$property->id, $link->id, $lease->id]));
        });
        Breadcrumbs::for('lease-bill-display', function ($trail, $property, $link, $lease, $my) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Generate Bill', route('billing.display', [$property->id, $link->id, $lease->id, $my]));
        });
        Breadcrumbs::for('lease-oincome', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Other Income', route('oincome.group.lease', [$property->id, $link->id, $lease->id]));
        });