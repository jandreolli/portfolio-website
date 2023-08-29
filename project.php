<?php

$specificCSS = '<link rel="stylesheet" href="assets/css/project.css"/>';

require_once __DIR__ . '/assets/templates/head.php';
require_once __DIR__ . '/assets/php/ProjectDatabase.php';

$projectObj = new ProjectDatabase();
?>

<body>
    <header>
        <?php
        require_once __DIR__ . '/assets/templates/nav.php';
        ?>
    </header>

    <section>
        <?php
        // récupérer l'id dans l'URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $project = $projectObj->getProject((int) $_GET['id']);
            if (!$project) {
                header('Location: error.php');
                exit;
            }
        } else {
            // si id est incorrect --> page d'erreur
            header('Location: error.php');
            exit;
        }
        ?>

        <article id="article_main">
            <header>
                <img src="<?= $project['img']; ?>" alt="image du résultat du projet informatique réalisé" />
            </header>
            <section>
                <h2>
                    <?= $project['title']; ?>
                </h2>
                <?php
                $prog_languages = explode(',', $project['prog']);
                foreach ($prog_languages as $prog_language) {
                    echo "<h3>$prog_language</h3>";
                }
                ?>
                <p>
                    <?= $project['content']; ?>
                </p>
            </section>
        </article>

    </section>
    <?php
    require_once 'assets/templates/footer.php';
    ?>
</body>

</html>