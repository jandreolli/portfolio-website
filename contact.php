<?php
$specificCSS = '<link rel="stylesheet" href="assets/css/form.css"/>';

require_once __DIR__ . '/assets/templates/head.php';
require_once __DIR__ . '/assets/php/PostForm.php';

$postForm = new PostForm(); // créer une instance PostForm
?>

<body>
    <header class="main_header">
        <?php
        require_once __DIR__ . '/assets/templates/nav.php';
        ?>
    </header>
    <section id="comments_container">
        <h1>
            <?= $languages['form']; ?>
        </h1>
        <form method="POST">

            <article>
                <label for="firstName">
                    <?= $languages['name1']; ?>
                </label>
                <input type="text" id="firstName" name="firstName" required aria-required="true"
                    aria-labelledby="firstName" />
            </article>

            <article>
                <label for="lastName">
                    <?= $languages['name2']; ?>
                </label>
                <input type="text" id="lastName" name="lastName" required aria-required="true"
                    aria-labelledby="lastName" />
            </article>

            <article>
                <label for="url">URL</label>
                <input type="url" id="url" name="url" aria-labelledby="url" />
            </article>

            <article>
                <label for="message">Message*</label>
                <textarea id="message" name="message" cols="30" rows="10" required aria-required="true"
                    aria-labelledby="message"></textarea>
            </article>

            <button type="submit">
                <?= $languages['send']; ?>
            </button>
        </form>

        <section>
            <?php foreach ($postForm->getDisplayMessageDESC() as $message): ?>
                <article>
                    <p>
                        <?php if ($message['url_txt']): ?>
                            <a href="<?= $message['url_txt']; ?>" target="_blank">
                                <?= $message['first_name']; ?>
                                <?= $message['last_name']; ?>
                            </a>
                        <?php else: ?>
                            <?= $message['first_name']; ?>
                            <?= $message['last_name']; ?>
                        <?php endif; ?>
                    </p>
                    <p>
                        <?= $message['message_txt']; ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </section>
    </section>
    <?php
    require_once __DIR__ . '/assets/templates/footer.php';
    ?>
    <script src="/assets/js/veriContact.js"></script>
</body>

</html>