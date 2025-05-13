<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Pop it MVC</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <nav>
        <div class="wrapper">
            <h1>Отдел кадров</h1>
            <div class="nav-buttons">
                <?php
                    if (app()->auth::check()):
                ?>
                    <a href="">Администрирование</a>
                    <a href="<?= app()->route->getUrl('/employees')?>">Сотрудники</a>
                    <a href="<?= app()->route->getUrl('/units')?>">Подразделения</a>
                    <a href="<?= app()->route->getUrl('/logout')?>">Выход</a>
                <?php
                    endif;
                ?>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="wrapper">
        <?= $content ?? '' ?>
    </div>
</main>

</body>
</html>