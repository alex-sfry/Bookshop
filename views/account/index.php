<?php include(ROOT . '/views/layouts/header.php') ?>

<main class="main">
    <section class="account">
        <div class="account-container">
            <div class="account__top">
                <h1 class="account__title">
                    Личный кабинет
                </h1>
                <h2 class="account__name">
                    <?= $user['name']; ?>
                </h2>
            </div>

            <ul>
                <li class="account__link">
                    <a href="/account/edit/">Редактировать данные</a>
                </li>
                <li class="account__link">
                    <a href="/account/history/">Список покупок</a>
                </li>
            </ul>
        </div>
    </section>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>