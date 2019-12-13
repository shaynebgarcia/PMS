<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('switch', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Switch Properties');
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
    Breadcrumbs::for('payment-show', function ($trail, $payment) {
        $trail->parent('payment');
        $trail->push($payment->reference_no, route('payment.show', $payment->slug));
    });
    Breadcrumbs::for('payment-edit', function ($trail, $payment) {
        $trail->parent('payment-show', $payment);
        $trail->push('Update Payment', route('payment.edit', $payment->slug));
    });

// INVENTORY
Breadcrumbs::for('inventory', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Inventory', route('inventory.index'));
});
    Breadcrumbs::for('inventory-create', function ($trail) {
        $trail->parent('inventory');
        $trail->push('Create Item', route('inventory.create'));
    });
    Breadcrumbs::for('inventory-show', function ($trail, $inventory) {
        $trail->parent('inventory');
        $trail->push($inventory->code, route('inventory.show', $inventory->id));
    });
    Breadcrumbs::for('inventory-edit', function ($trail, $inventory) {
        $trail->parent('inventory-show', $inventory);
        $trail->push('Update Item', route('inventory.edit', $inventory->id));
    });

// INVENTORY
Breadcrumbs::for('order', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Job Orders', route('orders.index'));
});
    Breadcrumbs::for('order-create', function ($trail) {
        $trail->parent('order');
        $trail->push('Create Order', route('orders.create'));
    });
    Breadcrumbs::for('order-show', function ($trail, $order) {
        $trail->parent('order');
        $trail->push($order->code, route('orders.show', $order->id));
    });
    Breadcrumbs::for('order-edit', function ($trail, $order) {
        $trail->parent('order-show', $order);
        $trail->push('Update Order', route('orders.edit', $order->id));
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
Breadcrumbs::for('tenant', function ($trail, $property) {
    $trail->parent('property', $property);
    $trail->push('Tenants', route('tenant.index'));
});
    Breadcrumbs::for('tenant-create', function ($trail, $property) {
        $trail->parent('tenant', $property);
        $trail->push('Create Tenant', route('tenant.create'));
    });
    Breadcrumbs::for('tenant-show', function ($trail, $property, $tenant) {
        $trail->parent('tenant', $property);
        $trail->push($tenant->user->fullnamewm, route('tenant.show', $tenant->user->slug));
    });

// PROPERTY
Breadcrumbs::for('property', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Properties', route('property.index'));
});
    Breadcrumbs::for('property-current', function ($trail, $property) {
        $trail->parent('dashboard');
        $trail->push($property->name);
    });
    Breadcrumbs::for('property-show', function ($trail, $property) {
        $trail->parent('property');
        $trail->push($property->name, route('property.show', $property->code));
    });
    Breadcrumbs::for('property-create', function ($trail) {
        $trail->parent('property');
        $trail->push('Create Property', route('property.create'));
    });
    Breadcrumbs::for('property-edit', function ($trail, $property) {
        $trail->parent('property-show', $property);
        $trail->push('Update Property Details', route('property.edit', $property->code));
    });
// UNIT
Breadcrumbs::for('unit', function ($trail, $property) {
    $trail->parent('property-show', $property);
    $trail->push('Units', route('unit.index'));
});
    Breadcrumbs::for('unit-create', function ($trail, $property) {
        $trail->parent('unit', $property);
        $trail->push('Create Unit', route('unit.create', $property->code));
    });
    Breadcrumbs::for('unit-edit', function ($trail, $property, $unit) {
        $trail->parent('unit', $property);
        $trail->push($unit->number, route('unit.edit', [$property->code, $unit->id]));
    });
        Breadcrumbs::for('unit-type-create', function ($trail, $property) {
            $trail->parent('property-show', $property);
            $trail->push('Create Unit Type', route('unit-type.create', $property->code));
        });
        Breadcrumbs::for('unit-type-edit', function ($trail, $property, $unitType) {
            $trail->parent('property', $property);
            $trail->push($unitType->name, route('unit-type.edit', [$property->code, $unitType->id]));
        });
    Breadcrumbs::for('unit-show', function ($trail, $property, $unit) {
        $trail->parent('property', $unit->property);
        $trail->push($unit->number, route('unit.show', [$property->code, $unit->id]));
    });
    Breadcrumbs::for('bill', function ($trail, $property) {
        $trail->parent('property', $property);
        $trail->push('Billing Invoices', route('billing.index', $property->code));
    });

// UTILITY
Breadcrumbs::for('utility', function ($trail, $property) {
    $trail->parent('property-show', $property);
    $trail->push('Utilities', route('utilities.index'));
});
Breadcrumbs::for('utility-create', function ($trail, $property) {
    $trail->parent('utility', $property);
    $trail->push('Create Utility', route('utilities.create'));
});
Breadcrumbs::for('utility-show', function ($trail, $property, $utility) {
    $trail->parent('utility', $property);
    $trail->push($utility->no);
});
Breadcrumbs::for('utility-edit', function ($trail, $property, $utility) {
    $trail->parent('utility-show', $property, $utility);
    $trail->push('Update Utility', route('utilities.edit', $utility->id));
});
Breadcrumbs::for('utility-bill', function ($trail, $property) {
    $trail->parent('property', $property);
    $trail->push('Utility Billing', route('utility-bill.index', $property->code));
});

// SERVICES
Breadcrumbs::for('service', function ($trail, $property) {
    $trail->parent('property-show', $property);
    $trail->push('Utilities', route('services.index'));
});
Breadcrumbs::for('service-create', function ($trail, $property) {
    $trail->parent('service', $property);
    $trail->push('Create Utility', route('services.create'));
});
Breadcrumbs::for('service-show', function ($trail, $property, $service) {
    $trail->parent('service', $property);
    $trail->push($service->no);
});
Breadcrumbs::for('service-edit', function ($trail, $property, $service) {
    $trail->parent('service-show', $property, $service);
    $trail->push('Update Utility', route('services.edit', $service->id));
});
Breadcrumbs::for('service-type-index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Services and Subscriptions', route('service-type.index'));
});
Breadcrumbs::for('service-type-create', function ($trail) {
    $trail->parent('service');
    $trail->push('Create Utility', route('services.create'));
});
Breadcrumbs::for('service-type-show', function ($trail, $service) {
    $trail->parent('service');
    $trail->push($service->no);
});
Breadcrumbs::for('service-type-edit', function ($trail, $service) {
    $trail->parent('service-show', $service);
    $trail->push('Update Utility', route('services.edit', $service->id));
});
// LEASE
Breadcrumbs::for('lease', function ($trail, $property) {
    $trail->parent('property-current', $property);
    $trail->push('Leasing Agreements', route('lease.index'));
});
    Breadcrumbs::for('lease-create', function ($trail, $property) {
        $trail->parent('lease', $property);
        $trail->push('Create Leasing Agreement', route('lease.create'));
    });
    
    Breadcrumbs::for('lease-show', function ($trail, $property, $link) {
        $trail->parent('lease', $property, $link);
        $trail->push($link->link_id);
    });

    Breadcrumbs::for('lease-renew', function ($trail, $property, $lease) {
        $trail->parent('lease-show', $property, $lease);
        $trail->push('Renew Contract', route('lease.renewform', $lease->id));
    });


    Breadcrumbs::for('lease-detail-show', function ($trail, $property, $link, $lease) {
        $trail->parent('lease-show', $property, $link, $lease);
        $trail->push($lease->agreement_no);
    });

        Breadcrumbs::for('lease-bill', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Billing', route('billing.group.lease', [$property->code, $link->id, $lease->id]));
        });
        Breadcrumbs::for('lease-bill-display', function ($trail, $property, $link, $lease, $my) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Generate Bill', route('billing.display', [$property->code, $link->id, $lease->id, $my]));
        });
        Breadcrumbs::for('lease-payment', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Payments & Deposits', route('payment.group.lease', [$property->code, $link->id, $lease->id]));
        });
        Breadcrumbs::for('lease-oincome', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Other Income', route('oincome.group.lease', [$property->code, $link->id, $lease->id]));
        });
        Breadcrumbs::for('lease-utility', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Utility Bill', route('utility-bill.group.lease', [$property->code, $link->id, $lease->id]));
        });
        Breadcrumbs::for('lease-service', function ($trail, $property, $link, $lease) {
            $trail->parent('lease-detail-show', $property, $link, $lease);
            $trail->push('Service Bill', route('service.group.lease', [$property->code, $link->id, $lease->id]));
        });