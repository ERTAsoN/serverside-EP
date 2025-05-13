<?php

namespace Controller;

use Src\View;
use Model\Employee;

class EmployeeController
{
    public function employees(): string
    {
        $query = Employee::query();

        // Фильтрация по подразделению
        if (!empty($_POST['unit_id'])) {
            $query->where('unit_id', $_POST['unit_id']);
        }

        // Фильтрация по составу
        if (!empty($_POST['staff_id'])) {
            $query->where('staff_id', $_POST['staff_id']);
        }

        // Сортировка
        if (!empty($_POST['sort_by'])) {
            $query->orderBy($_POST['sort_by']);
        }

        $employees = $query->get();

        foreach ($employees as $employee) {
            $employee->gender_id = $employee->gender->abbreviation;
            $employee->position_id = $employee->position->title;
            $employee->unit_id = $employee->unit->title;
            $employee->staff_id = $employee->staff->title;
        }

        return new View('site.employees', [
            'employees' => $employees,
            'units' => Unit::all(),
            'staffs' => Staff::all(),
        ]);
    }
}