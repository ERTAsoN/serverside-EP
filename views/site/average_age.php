<div class="display">
    <div class="display-buttons">
        <a href="<?= app()->route->getUrl('/employees')?>" class="button">Назад к списку</a>
    </div>
    <table>
        <thead>
        <tr>
            <th>Подразделение</th>
            <th>Средний возраст</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($units as $unit): ?>
            <tr>
                <td><?= $unit->title ?></td>
                <td>
                    <?php if ($unit->average_age): ?>
                        <?= round($unit->average_age) ?> лет
                    <?php else: ?>
                        Нет данных
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>