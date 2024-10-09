<?php
return [

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
            ]
            
    ]
];
