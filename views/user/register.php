<?php include(ROOT . '/views/layouts/header.php') ?>

<main class="main">
    <section class="signup">
        <div class="reg-form-container">
            <?php
            if ($result) {
                echo "<span class='signup__success'>Вы зарегистрировались!</span>";
            } else

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<span>$error</span>";
                }

                $errors = [];
            }
            ?>

            <h1 class="signup__title">Регистрация на сайте</h1>
            <form action="" method="POST" class="reg-form">
                <input type="text" name="name" placeholder="Имя" value="<?php echo $name ?>">
                <input type="email" name="email" placeholder="Email" value="<?php echo $email ?>">
                <input type="password" name="password" placeholder="Пароль" value="<?php echo $password ?>">
                <button type="submit" name="submit" class="reg-form__btn-submit">Регистрация</button>
            </form>
        </div>
    </section>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>