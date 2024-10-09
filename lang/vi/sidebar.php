<?php
return [
     /*
    |--------------------------------------------------------------------------
    | Dòng ngôn ngữ sidebar
    |--------------------------------------------------------------------------
    |
    | Những dòng ngôn ngữ sau đây được sử dụng trong sidebar
    |
    */

    'function' => [
            [
                'name' => 'Quản lý thành viên',
                'icon' => '<i class="nav-icon fa-solid fa-users"></i>',
                'route' => ['user'],
                'module' => [
                    [
                        'name' => 'Danh sách thành viên',
                        'path' => route('user.index')
                    ],
                    [
                        'name' => 'Quản lý quyền',
                        'path' => route('user.create')
                    ]
                    
                ]
            ],
            [
                'name' => 'Quản lý sản phẩm',
                'icon' => '<i class="nav-icon fas fa-box"></i>',
                'route' => ['product'],
                'module' => [
                    [
                        'name' => 'Danh sách sản phẩm',
                        'path' => route('product.index')
                    ],
                    [
                        'name' => 'Danh sách thuộc tính',
                        'path' => route('product.attribute.index')
                    ]
                    
                ]
            ],
            [
                'name' => 'Quản lý danh mục',
                'icon' => '<i class="bi bi-list"></i>',
                'route' => ['category'],
                'module' => [
                    [
                        'name' => 'Danh sách danh mục',
                        'path' => route('category.index')
                    ]                    
                ]
            ]
            
    ]
];
