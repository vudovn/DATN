<?php  
    return [
        'publish' => [
            0 => [
                'id' => 1,
                'name' => 'Un Publish'
            ],
            1 => [
                'id' => 2,
                'name' => 'Publish'
            ]
        ],
        'perpage' => array_map(function($item){
            return [
                'id' => $item,
                'name' => $item.' records',
            ];
        }, range(20, 200, 20)),
        'sort' => [
            0 => [
                'id' => 'id,desc',
                'name' => 'From Old To New'
            ],
            1 => [
                'id' => 'id,asc',
                'name' => 'From New To Old'
            ],
            2 => [
                'id' => 'name,asc',
                'name' => 'Name A - Z'
            ],
            3 => [
                'id' => 'name,desc',
                'name' => 'Name Z - A'
            ]
        ],

        'actions' => [
            0 => [
                'id' => 'delete',
                'name' => 'Delete'
            ],
            1 => [
                'id' => 'publish-2',
                'name' => 'Publish'
            ],
            2 => [
                'id' => 'publish-1',
                'name' => 'UnPublish'
            ],
        ],

    ];