<?php
$specificCSS = '<link rel="stylesheet" href="assets/css/form.css"/>';
// $specificJS = '<script src="/assets/js/veriSearch.js"> type="module" defer></script>';
require_once __DIR__ . '/assets/templates/head.php';
require_once __DIR__ . '/assets/php/ProjectDatabase.php';
require_once __DIR__ . '/assets/php/GetForm.php';

?>

<body>
    <header>
        <?php
        require_once __DIR__ . '/assets/templates/nav.php';
        ?>
    </header>

    <section id="search_main">
        <form method="GET">
            <article>
                <label for="search">
                <?= $languages['search']; ?>
                </label>
                <input type="text" 
                id="search" 
                name="search" placeholder="Zombie ipsum..."
                required 
                aria-required="true" 
                aria-labelledby="search" />
            </article>
            <button type="button">
            <?= $languages['send']; ?>
            </button>
        </form>
        <section id="search_results">

        </section>
    </section>
    <?php
    require_once __DIR__ . '/assets/templates/footer.php';
    ?>
    <script src="/assets/js/loadSearch.js"></script>
    <script src="/assets/js/veriSearch.js"></script> 
</body>

</html>