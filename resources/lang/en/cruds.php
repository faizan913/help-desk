<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],

    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'title'              => 'Title',
            'permissions'        => 'Permissions',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'name'                     => 'Name',
            'email'                    => 'Email',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
        ],
    ],
    'status'         => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'name'              => 'Name',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'service'         => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                => 'ID',
            'name'              => 'Name',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],

    'department'         => [
        'title'          => 'Departments',
        'title_singular' => 'Department',
        'fields'         => [
            'id'                => 'ID',
            'name'              => 'Name',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'priority'       => [
        'title'          => 'Priorities',
        'title_singular' => 'Priority',
        'fields'         => [
            'id'                => 'ID',
            'name'              => 'Name',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],

    'ticket'         => [
        'title'          => 'Tickets',
        'title_singular' => 'Ticket',
        'fields'         => [
            'id'                      => 'ID',
            'title'                   => 'Title',
            'system'                  => 'System name',
            'content'                 => 'Content',
            'status'                  => 'Status',
            'priority'                => 'Priority',
            'category'                => 'Category',
            'author_name'             => 'Author Name',
            'author_email'            => 'Author Email',
            'assigned_to_user'        => 'Assigned To User',
            'comments'                => 'Comments',
            'created_at'              => 'Created at',
            'updated_at'              => 'Updated at',
            'deleted_at'              => 'Deleted at',
            'attachments'             => 'Attachments',
        ],
    ],
    'comment'        => [
        'title'          => 'Comments',
        'title_singular' => 'Comment',
        'fields'         => [
            'id'                  => 'ID',
            'ticket'              => 'Ticket',
            'author_name'         => 'Author Name',
            'author_email'        => 'Author Email',
            'user'                => 'User',
            'comment'        => 'Comment',

        ],


    ],
    'question'         => [
        'title'          => 'Questions',
        'title_singular' => 'Question',
        'fields'         => [
            'id'                => 'ID',
            'question'              => 'Question',
            'ans'               => 'Answer',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],

];
