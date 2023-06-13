<?php include(ROOT . '/views/layouts/header.php') ?>

<main class="main">
    <div class="main-container">
        <section class="categories">
            <div class="catalog">
                <ul class="catalog-ul">
                    <?php foreach ($category as $categoryItem) : ?>
                        <li class="catalog-ul__item">
                            <a href="/category/<?php echo $categoryItem['id']; ?>">
                                <?php echo $categoryItem['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
        <div class="product-container">
            <div class="product-info">
                <button class="product-info__back"><-- Назад</button>
                        <div class="product-info__left">
                            <img src="<?php echo $product['image'] ?>" alt="">
                        </div>
                        <div class="product-info__right">
                            <div class="product-info__info">
                                <p class="product-info__author"><?php echo $product['author'] ?></p>
                                <h1 class="product-info__title"><?php echo $product['name'] ?></h1>
                                <p class="product-info__description"><?php echo $product['description'] ?></p>
                            </div>
                            <div class="product-info__to-cart">
                                <p><?php echo $product['price']; ?> руб.</p>
                                <input class="product-info__qty" type="number">
                                <button 
                                    class="product-card__to-cart add-to-cart"
                                    data-id="<?=$product['id']; ?>"
                                >
                                    В корзину
                                </button>
                            </div>
                        </div>
            </div>
        </div>
    </div>

</main>
<?php include(ROOT . '/views/layouts/footer.php') ?>