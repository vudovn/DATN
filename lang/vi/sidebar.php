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
                    // [
                    //     'name' => 'Quản trị viên',
                    //     'path' => route('user.admin.index')
                    // ],
                    [
                        'name' => 'Quản lý phân quyền',
                        'path' => route('permission.index')

                    ]
                    
                ]
            ],
            [
                'name' => 'Quản lý sản phẩm',
                'icon' => '<i class="nav-icon fas fa-box"></i>',
                'route' => ['product'],
                'module' => [
                    [
                        'name' => 'Sản phẩm',
                        'path' => route('product.index')
                    ],
                    [
                        'name' => 'Thuộc tính',
                        'path' => route('attributeCategory.index')
                    ]
                    
                ]
            ],
            [
                'name' => 'Quản lý đơn hàng',
                'icon' => '<i class="nav-icon fas fa-box"></i>',
                'route' => ['order'],
                'module' => [
                    [
                        'name' => 'Quản lý tình trạng',
                        'path' => route('admin.pages.order.index')
                    ]
                ]
            ]
            
    ]
];