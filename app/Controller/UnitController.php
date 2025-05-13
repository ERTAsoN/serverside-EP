<?php

namespace Controller;

use Src\View;
use Model\Unit;
use Model\UnitType;

class UnitController
{
    public function units(): string
    {
        $query = Unit::query()
            ->select(['units.*', 'unit_types.title as type_title'])
            ->leftJoin('unit_types', 'units.type_id', '=', 'unit_types.id');

        // Фильтрация по виду
        if (!empty($_POST['type_id'])) {
            $query->where('type_id', $_POST['type_id']);
        }

        // Сортировка
        $sortColumns = [
            'id' => 'units.id',
            'title' => 'units.title',
            'type' => 'unit_types.title'
        ];

        if (!empty($_POST['sort_by']) && isset($sortColumns[$_POST['sort_by']])) {
            $query->orderBy($sortColumns[$_POST['sort_by']]);
        }

        $units = $query->get();

        return new View('site.units', [
            'units' => $units,
            'unitTypes' => UnitType::all()
        ]);
    }

    public function createForm(): string
    {
        return new View('site.add_unit', [
            'unitTypes' => UnitType::all()
        ]);
    }

    public function store(): void
    {
        // Валидация обязательных полей
        if (empty($_POST['title'])) {
            app()->route->redirect('/units/add');
            return;
        }

        Unit::create([
            'title' => $_POST['title'],
            'type_id' => $_POST['type_id'] ?? null
        ]);

        app()->route->redirect('/units');
    }
}