<!--  -->
<?php
return [
    'active' => [
        0 => [
            'id' => 1,
            'name' => 'Kích hoạt'
        ],
        1 => [
            'id' => 2,
            'name' => 'Không kích hoạt'
        ]
    ],
    'publish' => [
        0 => [
            'id' => 1,
            'name' => 'Xuất bản'
        ],
        1 => [
            'id' => 2,
            'name' => 'Chưa xuất bản'
        ]
    ],
    'perpage' => array_map(function ($item) {
        return [
            'id' => $item,
            'name' => $item . ' hàng',
        ];
    }, range(20, 50, 10)),
    'sort' => [
        0 => [
            'id' => 'id,desc',
            'name' => 'Từ cũ đến mới'
        ],
        1 => [
            'id' => 'id,asc',
            'name' => 'Từ mới đến cũ'
        ],
        2 => [
            'id' => 'name,asc',
            'name' => 'Tên A - Z'
        ],
        3 => [
            'id' => 'name,desc',
            'name' => 'Tên Z - A'
        ]
    ],
    'actions' => [
        0 => [
            'id' => 'delete',
            'name' => 'Xóa'
        ],
        1 => [
            'id' => 'publish-1',
            'name' => 'Xuất bản'
        ],
        2 => [
            'id' => 'publish-2',
            'name' => 'Không xuất bản'
        ],
    ],
    'rating' => [
        0 => [
            'id' => 1,
            'name' => '1 sao'
        ],
        1 => [
            'id' => 2,
            'name' => '2 sao'
        ],
        2 => [
            'id' => 3,
            'name' => '3 sao'
        ],
        3 => [
            'id' => 4,
            'name' => '4 sao'
        ],
        4 => [
            'id' => 5,
            'name' => '5 sao'
        ]
    ],
    'is_featured' => [
        0 => [
            'id' => 1,
            'name' => 'Nổi bật'
        ],
        1 => [
            'id' => 2,
            'name' => 'Không nổi bật'
        ]
    ],
    'has_attribute' => [
        0 => [
            'id' => 1,
            'name' => 'Có'
        ],
        1 => [
            'id' => 2,
            'name' => 'Không'
        ]
    ],

];
