<?php

namespace Controller;

use Model\Gender;
use Model\Position;
use Src\View;
use Model\Employee;
use Model\Unit;
use Model\Staff;

class EmployeeController
{
    public function employees(): string
    {
        $query = Employee::query()
            ->select([
                'employees.*',
                'genders.abbreviation as gender_abbreviation',
                'units.title as unit_title',
                'staff.title as staff_title',
                'positions.title as position_title',
            ])
            ->leftJoin('genders', 'employees.gender_id', '=', 'genders.id')
            ->leftJoin('units', 'employees.unit_id', '=', 'units.id')
            ->leftJoin('staff', 'employees.staff_id', '=', 'staff.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id');

        // Фильтрация
        if (!empty($_POST['unit_id'])) {
            $query->where('unit_id', $_POST['unit_id']);
        }

        if (!empty($_POST['staff_id'])) {
            $query->where('staff_id', $_POST['staff_id']);
        }

        // Сортировка
        $sortMapping = [
            'id' => 'employees.id',
            'last_name' => 'last_name',
            'name' => 'name',
            'gender' => 'gender.abbreviation',
            'birth_date' => 'birth_date',
            'unit_title' => 'units.title',
            'staff_title' => 'staff.title',
            'position_title' => 'positions.title'
        ];

        if (!empty($_POST['sort_by']) && isset($sortMapping[$_POST['sort_by']])) {
            $query->orderBy($sortMapping[$_POST['sort_by']]);
        }

        $employees = $query->get();

        return new View('site.employees', [
            'employees' => $employees,
            'units' => Unit::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function averageAgeByUnit(): string
    {
        $units = Unit::query()
            ->selectRaw('
            units.*, 
            AVG(TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE())) as average_age
        ')
            ->leftJoin('employees', 'units.id', '=', 'employees.unit_id')
            ->groupBy('units.id')
            ->get();

        return new View('site.average_age', ['units' => $units]);
    }

    public function addEmployeeForm(): string
    {
        return new View('site.add_employee', [
            'genders' => Gender::all(),
            'positions' => Position::all(),
            'units' => Unit::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function addEmployee(): void
    {
        // Валидация обязательных полей
        $required = ['last_name', 'name', 'gender_id', 'birth_date', 'address', 'position_id', 'unit_id', 'staff_id'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                // Можно добавить обработку ошибок
                app()->route->redirect('/employees/add');
                return;
            }
        }

        // Создание сотрудника
        $employee = Employee::create([
            'last_name' => $_POST['last_name'],
            'name' => $_POST['name'],
            'patronym' => $_POST['patronym'] ?? null,
            'gender_id' => $_POST['gender_id'],
            'birth_date' => $_POST['birth_date'],
            'address' => $_POST['address'],
            'position_id' => $_POST['position_id'],
            'unit_id' => $_POST['unit_id'],
            'staff_id' => $_POST['staff_id'],
        ]);

        // Перенаправление после успешного добавления
        app()->route->redirect('/employees');
    }
}