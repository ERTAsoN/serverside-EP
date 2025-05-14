<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'antiauth' => \Middlewares\AntiAuthMiddleware::class,
        'admin' => \Middlewares\AdminMiddleware::class,
    ],
    'validators' => [
        'required' => \Validators\RequiredValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'email' => \Validators\EmailValidator::class
    ]
];