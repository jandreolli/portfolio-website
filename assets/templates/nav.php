<nav>
    <img src="assets/img/icone.png" alt="Icône d'un pingouin" />
    <ul class="nav-menu nav-menu-hidden">
        <li><a href="index.php">
                <?= $languages['home']; ?>
            </a></li>
        <li><a href="search.php">
                <?= $languages['search']; ?>
            </a></li>
        <li><a href="contact.php">Contact</a></li>

        <li> <a href="<?php echo isset($_GET['id']) ? 'project.php?id=' . $_GET['id'] . '&lang=fr' : '?lang=fr';
        ?>">Français</a>
        </li>
        <li> <a href="<?php echo isset($_GET['id']) ? 'project.php?id=' . $_GET['id'] . '&lang=en' : '?lang=en';
        ?>">English</a>
        </li>

    </ul>
    <i class="mdi mdi-menu burger"></i>
</nav>

<script src="/assets/js/menu.js"></script>