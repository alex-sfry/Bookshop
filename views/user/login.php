<?php include(ROOT . '/views/layouts/header.php') ?>

<main class="main">
    <section class="signup">
        <div class="reg-form-container">
            <?php
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<span>$error</span>";
                }

                $errors = [];
            }
            ?>

            <h1 class="signup__title">Вход на сайт</h1>
            <form action="" method="POST" class="reg-form">
                <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>">
                <input type="password" name="password" placeholder="Пароль" value="<?php echo $password ?>">
                <button type="submit" name="submit" class="reg-form__btn-submit">Войти</button>
            </form>
        </div>
    </section>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>