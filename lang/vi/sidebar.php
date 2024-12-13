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
                ],
                [
                    'name' => 'Danh sách phòng',
                    'path' => route('category.room.index')
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
        ],
        [
            'name' => 'Quản lý mã giảm giá',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-dollar-square"></use> </svg>',
            'route' => ['discount'],
            'module' => [
                [
                    'name' => 'Danh sách mã giảm giá',
                    'path' => route('discountCode.index')
                ]
            ]
        ],
        [
            'name' => 'Quản lý phản hồi',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-message-2"></use> </svg>',
            'route' => ['order'],
            'module' => [
                [
                    'name' => 'Quản lý bình luận',
                    'path' => route('comment.index')
                ],
                [
                    'name' => 'Quản lý đánh giá',
                    'path' => route('review.index')
                ],
                [
                    'name' => 'Quản lý nội dung bình luận',
                    'path' => route('CommentForbiddenWord.index')
                ]
            ]
        ],
        [
            'name' => 'Quản lý hệ thống',
            'icon' => '<svg class="pc-icon"> <use xlink:href="#custom-setting-2"></use> </svg>',
            'route' => route('setting.index'),
            'module' => []
        ]
    ]
];
