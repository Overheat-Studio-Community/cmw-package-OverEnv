<?php

return [
    'permissions' => [
        'main' => 'Permission principale pour gérer OverEnv',
    ],
    'pages' => [
        'main' => [
            'title' => 'OverEnv - Gérer',
            'description' => "Gérez vos variables d'environnement",
            'add' => [
                'title' => 'Ajouter une variable',
                'key' => 'Clé',
                'key_hint' => "Ne pas utiliser d'espaces, d'accents ou de caractères spéciaux !<br>Uniquement les underscore (_) sont autorisés.",
                'value' => 'Valeur',
            ],
        ],
    ],
    'toaster' => [
        'error' => [
            'fields_missing' => 'Champ manquant',
            'variable_not_found' => 'Variable introuvable',
            'unmodifiable_variable' => 'Variable non modifiable',
            'unable_to_update_variable' => 'Impossible de mettre à jour la variable',
            'variable_exists' => 'La variable existe déjà',
            'unable_to_create_variable' => 'Impossible de créer la variable',
        ],
        'success' => [
            'variable_updated' => 'Variable %key% modifiée',
            'variable_created' => 'Variable %key% créée',
        ],
    ],
];