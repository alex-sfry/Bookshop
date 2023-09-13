<?php include(ROOT . '/views/layouts/header.php'); ?>

<main class="main">
    <div class="main-container">
        <div class="categories">
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
        </div>
        <section class="books">
            <div class="books-grid">
                <?php foreach ($latestProducts as $product) : ?>
                    <div class="product-card">
                        <div class="product-card__img-div">
                            <img src="<?php echo $product['image']; ?>" alt="" width='120'>
                        </div>
                        <div class="product-card__text">
                            <div class="product-card__main">
                                <a href="<?php echo '/product/' . $product['id']; ?>">
                                    <p class="product-card__author"><?php echo $product['author']; ?></p>
                                    <h3 class="product-card__title"><?php echo $product['name']; ?></h3>
                                </a>
                            </div>
                            <div class="product-card__footer">
                                <p class="product-card__price"><?php echo $product['price']; ?> руб.</p>
                                <div class="product-card__add-to-cart">
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
                <?php endforeach; ?>
            </div>
            <?= $pagination->init(); ?>
        </section>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>