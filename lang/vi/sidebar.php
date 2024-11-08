<?php
return [

    'function' => [
        [
            'name' => 'Quản lý thành viên',
            'icon' => '<svg class="pc-icon"><use xlink:href="#custom-user"></use></svg>',
            'route' => ['user'],
            'module' => [
                [
                    'name' => 'Danh sách khách hàng',
                    'path' => route('user.index')
                ],
                [
                    'name' => 'Danh sách nhân viên',
                    'path' => route('user.admin.index')
                ],
            ]
        ],
        [
            'name' => 'Quản lý phân quyền',
            'icon' => '<svg class="pc-icon"><use xlink:href="#custom-shield"></use></svg>',
            'route' => ['permission'],
            'module' => [
                [
                    'name' => 'Danh sách quyền',
                    'path' => route('permission.index')
                ]
            ]
        ],
        [
            'name' => 'Quản lý sản phẩm',
            'icon' => '<svg class="pc-icon"><use xlink:href="#custom-shopping-bag"></use></svg>',
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
            'name' => 'Quản lý danh mục',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-element-plus"></use> </svg>',
            'route' => ['category'],
            'module' => [
                [
                    'name' => 'Danh sách danh mục',
                    'path' => route('category.index')
                ]
            ]
        ],
        [
            'name' => 'Quản lý bộ sưu tập',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-layer"></use> </svg>',
            'route' => ['collection'],
            'module' => [
                [
                    'name' => 'Danh sách bộ sưu tập',
                    'path' => route('collection.index')
                ]
            ]
        ],
        [
            'name' => 'Quản lý đơn hàng',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-box-1"></use> </svg>',
            'route' => ['order'],
            'module' => [
                [
                    'name' => 'Quản lý tình trạng',
                    'path' => route('order.index')
                ]
            ]
        ]

    ]
];