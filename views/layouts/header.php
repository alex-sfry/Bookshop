<?php 
use App\Model\User;
use App\Cart\Cart;
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book shop</title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="header-container">
                <div class="logo">Bookshop</div>
                <nav class="nav">
                    <ul class="nav-ul">
                        <li class="nav-ul__item"><a href="/">Главная</a></li>
                        <li class="nav-ul__item"><a href="/books/">Каталог</a></li>
                        <li class="nav-ul__item"><a href="/blog/">Блог</a></li>
                    </ul>
                </nav>
                <div class="header-right">

                    <?php if (User::isGuest()) : ?>

                        <div>
                            <a href="/user/login/">
                                Вход
                            </a>
                        </div>
                        <div>
                            <a href="/user/register/">
                                Регистрация
                            </a>
                        </div>

                    <?php else : ?>

                        <div>
                            <a href="/account/">
                                Аккаунт
                            </a>
                        </div>
                        <div>
                            <button class="account__logout">
                                <a href="/user/logout/">Выход</a>
                            </button>
                        </div>

                    <?php endif; ?>

                    <div>
                        <a href="/cart/">
                            Корзина
                            <span id="cart-count"><?=Cart::countItems();?></span>
                        </a>
                    </div>
                </div>
            </div>
        </header>