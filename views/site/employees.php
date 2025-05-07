<div class="display">
    <div class="display-buttons">
        <form method="POST">
            <div>
                <label>Подразделение:
                    <select>
                        <option>Подразделение 1</option>
                        <option>Подразделение 2</option>
                        <option>Подразделение 3</option>
                    </select>
                </label>
                <label>Состав:
                    <select>
                        <option>Состав 1</option>
                        <option>Состав 2</option>
                        <option>Состав 3</option>
                    </select>
                </label>
            </div>
            <div>
                <label>Сортировка:
                    <select>
                        <option>ID</option>
                        <option>Фамилия</option>
                        <option>Имя</option>
                        <option>Отчество</option>
                        <option>Дата рождения</option>
                        <option>Должность</option>
                        <option>Подразделение</option>
                        <option>Состав</option>
                    </select>
                </label>
                <a href="" class="button">Применить</a>
            </div>
        </form>
        <div>
            <div>
                <a href="" class="button">Добавить</a>
                <a href="" class="button">Подсчитать возраст</a>
            </div>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Адрес прописки</th>
            <th>Должность</th>
            <th>Подразделение</th>
            <th>Состав</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
            foreach ($employees as $employee) {
                echo '<td>' . $employee->id . '</td>'
                   . '<td>' . $employee->last_name . '</td>'
                   . '<td>' . $employee->name . '</td>'
                   . '<td>' . $employee->patronym . '</td>'
                   . '<td>' . $employee->gender->abbreviation . '</td>'
                   . '<td>' . $employee->birth_date . '</td>'
                   . '<td>' . $employee->address . '</td>'
                   . '<td>' . $employee->position->title . '</td>'
                   . '<td>' . $employee->unit->title . '</td>'
                   . '<td>' . $employee->staff->title . '</td>';
            }
            ?>
        </tr>
        </tbody>
    </table>
</div>