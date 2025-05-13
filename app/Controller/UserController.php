<?php

namespace Controller;

use Src\View;
use Model\User;
use Model\Role;

class UserController
{
    public function users(): string
    {
        $query = User::query()
            ->select(['users.*', 'roles.title as role_title'])
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id');

        // Фильтрация по роли
        if (!empty($_POST['role_id'])) {
            $query->where('role_id', $_POST['role_id']);
        }

        // Сортировка
        $sortColumns = [
            'id' => 'users.id',
            'email' => 'email',
            'role' => 'roles.title'
        ];

        if (!empty($_POST['sort_by']) && isset($sortColumns[$_POST['sort_by']])) {
            $query->orderBy($sortColumns[$_POST['sort_by']]);
        }

        $users = $query->get();

        return new View('site.users', [
            'users' => $users,
            'roles' => Role::all()
        ]);
    }
}