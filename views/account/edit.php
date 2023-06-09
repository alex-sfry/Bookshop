<?php include(ROOT . '/views/layouts/header.php') ?>

<main class="main">
    <section class="edit">
        <div class="reg-form-container">

            <?php
            if ($result) {
                echo "<span class='signup__success'>Данные отредактированы</span>";
            } else

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<span>$error</span>";
                }

                $errors = [];
            }
            ?>

            <h1 class="signup__title">Редактирование данных</h1>
            <form action="" method="POST" class="edit-form">
                <div>
                    <label>Имя:</label>
                    <input type="name" name="name" placeholder="name" value="<?php echo $name ?>">
                </div>

                <div>
                    <label>Пароль:</label>
                    <input type="password" name="password" placeholder="Пароль" value="<?php echo $password ?>">
                </div>
                <button type="submit" name="submit" class="edit-form__btn-submit">Cохранить</button>
            </form>
        </div>
    </section>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>