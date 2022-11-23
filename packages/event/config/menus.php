<?php
return [
    [
        'name' => "event-managements",
        "display_name" => "Event Managements",
        "icon" => "bi bi-people",
        "order" => 1,
        "permission" => "View Dashboard",
        "route" => "#"
    ],
    [
        "parent" => "event-managements",
        'name' => "events",
        "display_name" => "Events",
        "icon" => "bi bi-calendar-event",
        "order" => 1,
        "permission" => "Manage Events",
        "route" => "admin.events.index"
    ],
];
