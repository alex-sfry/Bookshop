<div class="wrapper">
    <?php include(ROOT . '/views/layouts/header.php') ?>

    <main class="main">
        <div class="main-container">
            <div class="categories">
                <div class="catalog">Каталог:
                    <ul class="catalog-ul">
                        <?php foreach ($category as $categoryItem) : ?>
                            <li class="catalog-ul__item">
                                <a href="/category/<?php echo $categoryItem['id']; ?>"
                                class="<?php if ($categoryId == $categoryItem['id']) echo 'active' ?>">
                                    <?php echo $categoryItem['name']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
            <section class="books">
                <div class="books-grid">
                    <?php foreach ($categoryProducts as $product) : ?>
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
                                    <p class="product-card__price"><?php echo $product['price']; ?></p>
                                    <div class="product-card__add-to-cart">
                                        <button>В корзину</button>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="btn-div">
                    <button class="btn-div__btn">Загрузить еще...</button>
                </div>
            </section>
        </div>
    </main>

    <?php include(ROOT . '/views/layouts/footer.php') ?>
</div>