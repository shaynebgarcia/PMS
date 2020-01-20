<?php

return [

    'app' => [
        'name' => 'PMS',
    ],

    'company' => [
        'name' => 'SMART MAIL',
    ],
    // Default currency to use
    'currency' => [
        'title' => 'Philippine Peso',
        'code' => 'PHP',
        'sign' => '₱',
    ],

    'unique_prefix' => [
        'user' => 'USR-',
        'tenant' => 'TNT-',
        'leasing_agreement' => 'LNK-',
        'leasing_agreement_details' => 'AGR-',
        'payment' => 'PYM-',
        'inventory' => 'INV-',
        'order' => 'ORD-',
        'service' => 'SRV-',
    ],

    'table' => [
        'th' => [
            'font-size' => 'f-14',
        ],
        'td' => [
            'font-size' => 'f-12',
        ],
    ],

    'action' => [
        'weight' => 'f-w-600',
        'size' => 'f-16',
        'margin' => 'm-r-5',
        'edit' => [
            'icon' => 'icon feather icon-edit',
            'color' => 'text-c-blue',
            'tool-tip-text' => 'Edit',
        ],
        'delete' => [
            'icon' => 'icon feather icon-trash-2',
            'color' => 'text-c-red',
            'tool-tip-text' => 'Delete',
        ],
        'add-stock' => [
            'icon' => 'icon feather icon-plus-circle',
            'color' => 'text-c-green',
            'tool-tip-text' => 'Add Stocks',
        ],
        'reduce-stock' => [
            'icon' => 'icon feather icon-minus-circle',
            'color' => 'text-c-yellow',
            'tool-tip-text' => 'Reduce Stocks',
        ],
    ],

    'utility' => [
        'electricity' => [
            'icon' => 'icon-zap',
            'color' => 'warning',
        ],
        'water' => [
            'icon' => 'icon-droplet',
            'color' => 'primary',
        ],
    ],

    'billing' => [
        'invoice' => [
            //Filtered ID format
            'num_filter' => '%03d',
            // Needs to be invoiced before
            'before_due_date' => '-7 day', 
            'before_due_date_limit' => '-3 day', 
            // After issuing invoice
            'after_due_date' => '+3 day',
            'after_due_date_limit' => '+1 day',
            'terms' => [
            ],
        ],
        'services' => [
            'days_to_get_daily_rate' => 30,
        ],
    ],

	'breadcrumbs' => [
        'default' => [
            'icon' => 'icon-home',
            'title' => 'Title',
            'subtitle' => 'lorem ipsum dolor sit amet, consectetur adipisicing elit',
        ],
        'property' => [
            'icon' => 'icon-home',
            'property-index' => [
                'title' => 'Properties',
                'subtitle' => 'Lists all properties',
            ],
            'property-show' => [
                'title' => '{ ? }',
                'subtitle' => 'Property details',
            ],
            'property-create' => [
                'title' => 'Create Property',
                'subtitle' => 'Form to create a new property',
            ],
            'property-edit' => [
                'title' => 'Update Property Details - ',
                'subtitle' => "Form to update an existing property's details",
            ],
        ],
        'unit' => [
            'icon' => 'icon-home',
            'unit-index' => [
                'title' => 'Units',
                'subtitle' => 'Lists all units under a property',
            ],
            'unit-show' => [
                'title' => '{ ? }',
                'subtitle' => 'Unit details',
            ],
            'unit-create' => [
                'title' => 'Create Unit',
                'subtitle' => 'Form to create a new unit under a property',
            ],
            'unit-edit' => [
                'title' => 'Update Unit Details - ',
                'subtitle' => "Form to update an existing unit's details",
            ],
        ],
        'unit-type' => [
            'icon' => 'icon-home',
            'unit-create' => [
                'title' => 'Create Unit Type',
                'subtitle' => 'Form to create a new unit type under a property',
            ],
            'unit-edit' => [
                'title' => 'Update Unit Type Details - ',
                'subtitle' => "Form to update an existing unit type's details",
            ],
        ],
        'payment' => [
            'icon' => 'icon-home',
            'payment-index' => [
                'title' => 'Payments',
                'subtitle' => 'List of all payments under a property',
            ],
            'payment-create' => [
                'title' => 'Create New Payment',
                'subtitle' => 'Form to create a new payment',
            ],
            'payment-edit' => [
                'title' => 'Update Payment Details - ',
                'subtitle' => "Form to update an existing payment details",
            ],
            'payment-group' => [
                'title' => 'Payments & Deposits',
                'subtitle' => 'Lists all payments and deposits under an agreement',
            ],
        ],
        'utility' => [
            'icon' => 'icon-zap',
            'utility-index' => [
                'title' => 'Utilities',
                'subtitle' => 'List of all utilities under a property',
            ],
            'utility-create' => [
                'title' => 'Create New Utility',
                'subtitle' => 'Form to create a new utility',
            ],
            'utility-edit' => [
                'title' => 'Update Utility Details - ',
                'subtitle' => "Form to update an existing utility details",
            ],
            'utility-bill-index' => [
                'title' => 'Utility Billing',
                'subtitle' => 'Lists all utility bill',
            ],
            'utility-bill-group' => [
                'title' => 'Utility Billing',
                'subtitle' => 'Lists all utility bill under an agreement',
            ],
        ],
        'service' => [
            'icon' => 'icon-briefcase',
            'service-index' => [
                'title' => 'Services & Subscriptions',
                'subtitle' => 'List of all service and/or subscription billing',
            ],
            'service-create' => [
                'title' => 'Create A New Service Agreement',
                'subtitle' => 'Form to create a new service agreement to bill',
            ],
            'service-edit' => [
                'title' => 'Update Service Details - ',
                'subtitle' => "Form to update an existing service bill details",
            ],
            'service-bill-group' => [
                'title' => 'Services & Subscription Billing',
                'subtitle' => "Lists all services billing",
            ],
            'service-type-index' => [
                'title' => 'Services & Subscriptions Types',
                'subtitle' => 'Lists all types of services and/or subscriptions',
            ],
            'service-type-create' => [
                'title' => 'Create A New Service Type',
                'subtitle' => 'Form to create a new service type',
            ],
            'service-type-edit' => [
                'title' => 'Update Service Type Details - ',
                'subtitle' => "Form to update an existing service type details",
            ],
        ],
        'lease' => [
            'icon' => 'icon-feather',
            'lease-index' => [
                'title' => 'Leasing Agreements',
                'subtitle' => 'List of all leasing agreements active/inactive',
            ],
            'lease-show' => [
                'title' => 'Lease Details',
                'subtitle' => 'Lease details and history',
            ],
            'lease-create' => [
                'title' => 'Create New Leasing Agreement',
                'subtitle' => 'Form to create a new leasing agreement',
            ],
            'lease-edit' => [
                'title' => 'Update Lease Agreement - ',
                'subtitle' => "Form to update an existing leasing agreement's details",
            ],
            'lease-renew' => [
                'title' => 'Renew Lease Agreement',
                'subtitle' => "Form to renew an existing leasing agreement",
            ],
        ],
        'bill' => [
            'icon' => 'icon-feather',
            'bill-index' => [
                'title' => 'Billing Invoices',
                'subtitle' => 'List of all billing invoices paid/un-paid',
            ],
            'bill-group' => [
                'title' => 'Billing Invoice',
                'subtitle' => 'Generate invoices. Displays published bill under an agreement',
            ],
            'bill-display' => [
                'title' => 'Generate Bill - ',
                'subtitle' => 'Displays a generated bill',
            ],
        ],
        'oincome' => [
            'icon' => 'icon-feather',
            'oincome-index' => [
                'title' => 'Other Incomes',
                'subtitle' => 'List of all other income',
            ],
            'oincome-group' => [
                'title' => 'Other Income',
                'subtitle' => 'Displays other income under an agreement',
            ],
        ],
        'user' => [
            'icon' => 'icon-user',

            'user-index' => [
                'title' => 'Users',
                'subtitle' => 'Lists all users',
            ],
            'user-show' => [
                'title' => '{ ? }',
                'subtitle' => 'User information',
            ],
            'user-create' => [
                'title' => 'User Create',
                'subtitle' => 'Form to create a new user account',
            ],
            'user-edit' => [
                'title' => 'Update User Details - ',
                'subtitle' => 'Form to update existing user',
            ],

            'tenant-index' => [
                'title' => 'Tenants',
                'subtitle' => 'Lists all users',
            ],
            'tenant-show' => [
                'title' => '{ ? }',
                'subtitle' => 'Tenant information',
            ],
            'tenant-create' => [
                'title' => 'Tenant Information Form',
                'subtitle' => 'Form to create a new tenant',
            ],
            'tenant-edit' => [
                'title' => 'Update Tenant Details - ',
                'subtitle' => 'Form to update existing tenant',
            ],
        ],
        'inventory' => [
            'icon' => 'icon-package',
            'inventory-index' => [
                'title' => 'Inventory Items',
                'subtitle' => 'List of all inventory items',
            ],
            'inventory-create' => [
                'title' => 'Create New Item',
                'subtitle' => 'Form to create a new inventory item',
            ],
            'inventory-edit' => [
                'title' => 'Update Item Details - ',
                'subtitle' => "Form to update an existing item's detail",
            ],
        ],
        'order' => [
            'icon' => 'icon-shopping-cart',
            'order-index' => [
                'title' => 'Job Orders',
                'subtitle' => 'List of all published job/work orders',
            ],
            'order-create' => [
                'title' => 'Create New Order',
                'subtitle' => 'Form to create a new job/work order',
            ],
            'order-edit' => [
                'title' => 'Update Order Details - ',
                'subtitle' => "Form to update an existing order's detail",
            ],
        ],
    ],





    'contract' => [
        // Needs to be notified before expiry
        'before_due_date' => '-3 month', 
        'before_due_date_limit' => '-1 month', 
    ],
];