<div class="add-edit">
    <h3>Добавить подразделение</h3>
    <form method="POST" action="<?= app()->route->getUrl('/add-unit') ?>">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

        <label>Название</label>
        <input type="text" name="title" required>

        <label>Вид</label>
        <select name="type_id" required>
            <?php foreach ($unitTypes as $type): ?>
                <option value="<?= $type->id ?>"><?= $type->title ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="button">Добавить</button>
    </form>
</div>