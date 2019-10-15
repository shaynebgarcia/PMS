<?php

return [

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
                'title' => 'Create Property',
                'subtitle' => 'Form to create a new property',
            ],
            'lease-edit' => [
                'title' => 'Update Property Details - ',
                'subtitle' => "Form to update an existing property's details",
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
            'before_due_date' => 7, //days
            'before_due_date_limit' => 3, //days
            // After issuing invoice
            'after_due_date' => 3,
            'after_due_date_limit' => 1,
        ],
    ],
];