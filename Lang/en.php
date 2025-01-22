<?php

return [
    'permissions' => [
        'main' => 'Main permission to manage OverEnv',
    ],
    'pages' => [
        'main' => [
            'title' => 'OverEnv - Manage',
            'description' => "Manage your environment variables",
            'add' => [
                'title' => 'Add a variable',
                'key' => 'Key',
                'value' => 'Value',
            ],
        ],
    ],
    'toaster' => [
        'error' => [
            'fields_missing' => 'Missing field',
            'variable_not_found' => 'Variable not found',
            'unmodifiable_variable' => 'Unmodifiable variable',
            'unable_to_update_variable' => 'Unable to update variable',
            'variable_exists' => 'Variable already exists',
            'unable_to_create_variable' => 'Unable to create variable',
        ],
        'success' => [
            'variable_updated' => 'Variable %key% updated',
            'variable_created' => 'Variable %key% created',
        ],
    ],
];