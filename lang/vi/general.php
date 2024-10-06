<!--  -->
<?php  
    return [
        'publish' => [
            0 => [
                'id' => 1,
                'name' => 'Chưa xuất bản'
            ],
            1 => [
                'id' => 2,
                'name' => 'Đã xuất bản'
            ]
        ],
        'perpage' => array_map(function($item){
            return [
                'id' => $item,
                'name' => $item.' hàng',
            ];
        }, range(10, 50, 10)),
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
                'id' => 'publish-2',
                'name' => 'Xuất bản'
            ],
            2 => [
                'id' => 'publish-1',
                'name' => 'Chưa xuất bản'
            ],
        ],

    ];
