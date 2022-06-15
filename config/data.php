<?php 

return [
    "route" => [
        "admin" => [
            "index" => "dashboard",
            "films" => [
                "index" => "films.index",
                "create" => "films.create",
                "store" => "films.store",
                "detail" => "films.show",
                "update" => "films.update",
                "edit" => "films.edit",
                "delete" => "films.destroy"
            ],
            "genres" => [
                "index" => "genres.index",
                "create" => "genres.create",
                "store" => "genres.store",
                "detail" => "genres.show",
                "update" => "genres.update",
                "edit" => "genres.edit",
                "delete" => "genres.destroy"
            ],
            "chaircategory" => [
                "index" => "chair-categories.index",
                "create" => "chair-categories.create",
                "store" => "chair-categories.store",
                "detail" => "chair-categories.show",
                "update" => "chair-categories.update",
                "edit" => "chair-categories.edit",
                "delete" => "chair-categories.destroy"
            ],
            "chairs" => [
                "index" => "chairs.index",
                "create" => "chairs.create",
                "store" => "chairs.store",
                "detail" => "chairs.show",
                "update" => "chairs.update",
                "edit" => "chairs.edit",
                "delete" => "chairs.destroy"
            ],
            "rooms" => [
                "index" => "rooms.index",
                "create" => "rooms.create",
                "store" => "rooms.store",
                "detail" => "rooms.show",
                "update" => "rooms.update",
                "edit" => "rooms.edit",
                "delete" => "rooms.destroy"
            ],
            "schedules" => [
                "index" => "schedules.index",
                "create" => "schedules.create",
                "store" => "schedules.store",
                "detail" => "schedules.show",
                "update" => "schedules.update",
                "edit" => "schedules.edit",
                "delete" => "schedules.destroy"
            ]
        ]
    ],
    "view" => [
        "admin" => [
            "films" => [
                "index" => "admin.film.index",
                "create" => "admin.film.create",
                "edit" => "admin.film.edit",
                "detail" => "admin.film.detail"
            ],
            "rooms" => [
                "index" => "admin.room.index",
                "create" => "admin.room.create",
                "edit" => "admin.room.edit",
                "detail" => "admin.room.detail"
            ],
            "schedules" => [
                "index" => "admin.schedule.index",
                "create" => "admin.schedule.create",
                "edit" => "admin.schedule.edit",
                "detail" => "admin.schedule.detail"
            ],
            "genres" => [
                "index" => "admin.genre.index",
                "create" => "admin.genre.create",
                "edit" => "admin.genre.edit",
                "detail" => "admin.genre.detail"
            ],
            "chaircategory" => [
                "index" => "admin.chaircategory.index",
                "create" => "admin.chaircategory.create",
                "edit" => "admin.chaircategory.edit",
                "detail" => "admin.chaircategory.detail"
            ],
            "chairs" => [
                "index" => "admin.chair.index",
                "create" => "admin.chair.create",
                "edit" => "admin.chair.edit",
                "detail" => "admin.chair.detail"
            ]
        ]
    ],
    "time" => [
        "min_hour" => 1,
        "max_hour" => 5,
        "min_minute" => 0,
        "max_minute" => 59,
        "min_year" => 2000,
        "max_year" => (int) date("Y") + 1
    ],
    "rating" => [
        "min_rating" => 7,
        "max_rating" => 21
    ],
    "chairPrice" => [
        "min" => 10000,
        "max" => 150000
    ],
    "chairRooms" => [
        "row" => [
            "min" => 1,
            "max" => 10
        ],
        "col" => [
            "min" => 10,
            "max" => 20
        ],
    ],
];
