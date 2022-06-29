<?php 

return [
    "route" => [
        "admin" => [
            "index" => "dashboard",
            "users" => [
                "index" => "users.index",
                "edit" => "users.edit",
                "edit" => "users.update"
            ],
            "films" => [
                "index" => "films.index",
                "create" => "films.create",
                "store" => "films.store",
                "detail" => "films.show",
                "update" => "films.update",
                "edit" => "films.edit",
                "delete" => "films.destroy",
                "search" => "films.search",
                "print" => "films.print"
            ],
            "genres" => [
                "index" => "genres.index",
                "create" => "genres.create",
                "store" => "genres.store",
                "detail" => "genres.show",
                "update" => "genres.update",
                "edit" => "genres.edit",
                "delete" => "genres.destroy",
                "search" => "genres.search",
                "print" => "genres.print"
            ],
            "roomcategory" => [
                "index" => "room-categories.index",
                "create" => "room-categories.create",
                "store" => "room-categories.store",
                "detail" => "room-categories.show",
                "update" => "room-categories.update",
                "edit" => "room-categories.edit",
                "delete" => "room-categories.destroy",
                "search" => "room-categories.search",
                "print" => "room-categories.print"
            ],
            "chairs" => [
                "index" => "chairs.index",
                "create" => "chairs.create",
                "store" => "chairs.store",
                "detail" => "chairs.show",
                "update" => "chairs.update",
                "edit" => "chairs.edit",
                "delete" => "chairs.destroy",
                "search" => "chairs.search",
                "print" => "chairs.print"
            ],
            "rooms" => [
                "preview" => [
                    "index" => "room-preview"
                ],
                "index" => "rooms.index",
                "create" => "rooms.create",
                "store" => "rooms.store",
                "detail" => "rooms.show",
                "update" => "rooms.update",
                "edit" => "rooms.edit",
                "delete" => "rooms.destroy",
                "search" => "rooms.search",
                "print" => "rooms.print"
            ],
            "schedules" => [
                "index" => "schedules.index",
                "create" => "schedules.create",
                "store" => "schedules.store",
                "detail" => "schedules.show",
                "update" => "schedules.update",
                "edit" => "schedules.edit",
                "delete" => "schedules.destroy",
                "search" => "schedules.search",
                "print" => "schedules.print"
            ]
        ]
    ],
    "view" => [
        "admin" => [
            "users" => [
                "index" => "admin.profile.index",
                "edit" => "admin.profile.edit"
            ],
            "films" => [
                "index" => "admin.film.index",
                "create" => "admin.film.create",
                "edit" => "admin.film.edit",
                "detail" => "admin.film.detail"
            ],
            "rooms" => [
                "preview" => [
                    "index" => "admin.room.preview.index"
                ],
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
            "roomcategory" => [
                "index" => "admin.roomcategory.index",
                "create" => "admin.roomcategory.create",
                "edit" => "admin.roomcategory.edit",
                "detail" => "admin.roomcategory.detail"
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
    "roomPrice" => [
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
