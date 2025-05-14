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

    public function addUserForm(): string
    {
        return new View('site.add_user', [
            'roles' => Role::all()
        ]);
    }

    public function addUser(): void
    {
        // Валидация обязательных полей
        $required = ['email', 'password', 'name', 'role_id'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                app()->route->redirect('/users/add');
                return;
            }
        }

        // Проверка уникальности email
        if (User::where('email', $_POST['email'])->exists()) {
            app()->route->redirect('/users/add');
            return;
        }

        // Создание пользователя
        User::create([
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'name' => $_POST['name'],
            'role_id' => $_POST['role_id'],
        ]);

        app()->route->redirect('/users');
    }

}