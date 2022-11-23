<?php

return [
    [
        'name' => "dashboard",
        "display_name" => "Dashboard",
        "icon" => "bi bi-house",
        "order" => 1,
        "permission" => "View Dashboard",
        "route" => "admin.dashboard"
    ],
    [
        'name' => "user-managements",
        "display_name" => "User Managements",
        "icon" => "bi bi-people",
        "order" => 1,
        "permission" => "View Dashboard",
        "route" => "#"
    ],
    [
        "parent" => "user-managements",
        'name' => "users",
        "display_name" => "Users",
        "icon" => "bi bi-people",
        "order" => 1,
        "permission" => "Manage Users",
        "route" => "admin.users.index"
    ],
    [
        'parent' => "user-managements",
        'name' => "roles",
        "display_name" => "Roles",
        "icon" => "bi bi-check2-all",
        "order" => 2,
        "permission" => "Manage Roles",
        "route" => "admin.roles.index"
    ],
    [
        'name' => "utility",
        "display_name" => "Utility",
        "icon" => "bi bi-tools",
        "order" => 1,
        "permission" => "View Dashboard",
        "route" => "#"
    ],
    [
        'parent' => "utility",
        'name' => "medias",
        "display_name" => "Medias",
        "icon" => "bi bi-images",
        "order" => 1,
        "permission" => "Manage Medias",
        "route" => "admin.medias.index"
    ],
    [
        'parent' => "utility",
        'name' => "email-templates",
        "display_name" => "Email Templates",
        "icon" => "bi bi-envelope",
        "order" => 1,
        "permission" => "Manage EmailTemplates",
        "route" => "admin.email-templates.index"
    ],
    [
        'parent' => "utility",
        'name' => "backups",
        "display_name" => "Backup",
        "icon" => "bi bi-safe",
        "order" => 1,
        "permission" => "Manage Backups",
        "route" => "admin.backups.index"
    ],
    [
        'parent' => "utility",
        'name' => "activities",
        "display_name" => "Activities",
        "icon" => "bi bi-safe",
        "order" => 1,
        "permission" => "Manage Activities",
        "route" => "admin.activities.index"
    ],

];
