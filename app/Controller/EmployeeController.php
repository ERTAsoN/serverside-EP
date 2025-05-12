<?php

namespace Controller;

use Src\View;
use Model\Employee;
class EmployeeController
{
    public function employees(): string
    {
        $employees = Employee::all();

        foreach($employees as $employee)
        {
            $employee['gender_id'] = $employee->gender()->first()->abbreviation;
            $employee['position_id'] = $employee->position()->first()->title;
            $employee['unit_id'] = $employee->unit()->first()->title;
            $employee['staff_id'] = $employee->staff()->first()->title;
        }

        return new View('site.employees', ['employees' => $employees]);
    }
}