<?php

return [

    'app' => [
        'name' => 'PMS',
    ],

    'company' => [
        'name' => 'SMART MAIL',
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
                'subtitle' => 'Lists all units',
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
    ],

    // Default currency to use
    'currency' => [
        'title' => 'Philippine Peso',
        'code' => 'PHP',
        'sign' => '₱',
    ],

    'billing' => [
        'invoice' => [
            // Needs to be invoiced before
            'before_due_date' => '-7 day', 
            'before_due_date_limit' => '-3 day', 
            // After issuing invoice
            'after_due_date' => '+3 day',
            'after_due_date_limit' => '+1 day',
            'terms' => [
                
            ],
        ],
    ],
    'contract' => [
        // Needs to be notified before expiry
        'before_due_date' => '-3 month', 
        'before_due_date_limit' => '-1 month', 
    ],
];