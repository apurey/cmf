<?php

return [
    'adminEmail' => 'webmaster@d7.home',
    'nav' => [
        [
            'label' => ['category' => 'project', 'context' => 'Management'],
            'items' => [
                [
                    'label' => ['category' => 'project', 'context' => 'Language'],
                    'url' => ['/cp/language'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => ['category' => 'project', 'context' => 'Page'],
                    'url' => ['/cp/page'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => ['category' => 'project', 'context' => 'Translation'],
                    'url' => ['/cp/translation'],
                ],
            ],
        ],
        [
            'label' => ['category' => 'project', 'context' => 'Administrators'],
            'items' => [
                [
                    'label' => ['category' => 'project', 'context' => 'Auth'],
                    'url' => ['/cp/auth'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => ['category' => 'project', 'context' => 'Role'],
                    'url' => ['/cp/auth/role'],
                ],
                '<li class="divider"></li>',
                [
                    'label' => ['category' => 'project', 'context' => 'Permission'],
                    'url' => ['/cp/auth/permission'],
                ],
            ],
        ],
    ],
];
