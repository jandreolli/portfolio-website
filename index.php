<?php
$specificCSS = '<link rel="stylesheet" href="assets/css/index.css"/>';
$specificJS = '<script src="assets/js/loadProject.js" type="module" defer></script>';

require_once __DIR__ . '/assets/templates/head.php';
?>

<body>
    <header>
        <?php
        require_once __DIR__ . '/assets/templates/nav.php';
        ?>
        <section>
            <img src="assets/img/name_background.jpg" alt="Photo d'un code de programmation" />
            <img src="assets/img/icone.png" alt="Icône d'un pingouin" />
        </section>
    </header>

    <main>

        <nav>
            <h1>
                <?= $languages['title']; ?>
            </h1>
            <input type="hidden" id="seeProject" value="<?= $languages['seeproject'] ?>">
        </nav>

        <button>
            <?= $languages['seemore']; ?>
        </button>
    </main>
    <?php
    require_once __DIR__ . '/assets/templates/footer.php';
    ?>
</body>

</html>