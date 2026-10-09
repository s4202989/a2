<?php
// Each page sets $current_page ('home', 'books', 'gallery' or 'add') so the right link is highlighted
$current_page = $current_page ?? '';
$nav_items = [
    'home'    => ['index.php',   'home',        'Home'],
    'books'   => ['books.php',   'menu_book',   'Browse Books'],
    'gallery' => ['gallery.php', 'collections', 'Gallery'],
    'add'     => ['add.php',     'add_circle',  'Add Book'],
];
?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Main navigation">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <img src="assets/images/favicon.svg" alt="BookVerse logo" width="30" height="30">
                BookVerse
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($nav_items as $key => $item): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo ($key === $current_page) ? ' active' : ''; ?>"
                           href="<?php echo $item[0]; ?>">
                            <span class="material-icons" aria-hidden="true"><?php echo $item[1]; ?></span>
                            <?php echo $item[2]; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>