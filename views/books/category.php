<?php include(ROOT . '/views/layouts/header.php') ?>
<main class="main">
    <div class="main-container">
        <div class="categories">
            <div class="catalog">
                <ul class="catalog-ul">
                    <?php foreach ($category as $categoryItem) : ?>
                        <li class="catalog-ul__item">
                            <a href="/category/<?php echo $categoryItem['id']; ?>" class="<?php if ($categoryId == $categoryItem['id']) echo 'active' ?>">
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
                                <p class="product-card__price"><?php echo $product['price']; ?> руб.</p>
                                <div class="product-card__add-to-cart">
                                    <button class="product-card__to-cart add-to-cart" data-id="<?= $product['id']; ?>">
                                        В корзину
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <ul class="pagination">
                <?php
                $last = 0;
                $range = intdiv($page,  4);
                //echo $range;

                // min page in page list
                $range >= 1 && $page > $range * 4 ? $i = 4 * $range + 1 : $i = 4 * $range - 3;
                $range == 0 && $i = 1;

                if ($page < 2 && $pages_count > 2) {
                    if ($pages_count > 3) {
                        $last = 4;
                    } else $last = $pages_count;
                } else $pages_count - $page > 3 ? $last = $page + 3 : $last = $pages_count;

                //max page in page list
                $range > 0 && $page > $range * 4 ? $last = ($range + 1) * 4 : $last = $range * 4;
                $range == 0 &&  $last = 4;
                $last > $pages_count && $last = $pages_count + 1;

                $visibility = '';

                // todo add css for pagination__arrow_visible, pagination__arrow,
                // pagination__link_current, pagination__link

                if ($pages_count > 1 && $page > 1) {
                    $visibility = 'class="pagination__arrow_visible"';
                } else $visibility = 'class="pagination__arrow"';

                echo "<li class='pagination__item'>
                        <a href='/category/" . $categoryId . "/page-" . $page - 1 . "' " . $visibility . "> < </a>
                        </li>";

                $cls = '';

                while ($i <= $last) {
                    $i == $page ? $cls = 'pagination__link_current' : $cls = 'pagination__link';
                    echo "<li class='pagination__item'>
                            <a href='/category/" . $categoryId . "/page-" . $i . "' " . $cls . ">" . $i . "</a>
                            </li>";
                    $i++;
                };

                if ($pages_count > 1 && $page < $pages_count) {
                    $visibility = 'class="pagination__arrow_visible"';
                } else $visibility = 'class="pagination__arrow"';

                echo "<li class='pagination__item'>
                        <a href='/category/" . $categoryId . "/page-" . $page + 1 . "' " . $visibility . "> > </a>
                        </li>";
                ?>
            </ul>
        </section>
    </div>
</main>

<?php include(ROOT . '/views/layouts/footer.php') ?>