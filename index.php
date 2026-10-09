<?php
include 'includes/db_connect.inc';

$page_title       = 'BookVerse | Home';
$page_description = 'BookVerse is a simple book management website. This is the home page.';
$current_page     = 'home';

// The 4 newest books (prepared statement)
$sql = "SELECT book_id, title, author, genre, price, status, image_path
        FROM books
        ORDER BY created_at DESC, book_id DESC
        LIMIT 4";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$books  = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

include 'includes/header.inc';
include 'includes/nav.inc';
?>

<main>
    <?php if (count($books) > 0): ?>
    <!-- Hero carousel: the 4 newest books -->
    <div id="bookCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($books as $i => $b):
                $title = htmlspecialchars($b['title']);
                $img   = htmlspecialchars($b['image_path']);
                $id    = (int)$b['book_id'];
            ?>
            <div class="carousel-item<?php echo ($i === 0) ? ' active' : ''; ?>">
                <img src="assets/images/covers/<?php echo $img; ?>" class="d-block w-100 carousel-img"
                     alt="<?php echo $title; ?> cover art">
                <div class="carousel-caption">
                    <h2><?php echo $title; ?></h2>
                    <a href="details.php?id=<?php echo $id; ?>" class="btn btn-view-details">
                        <span class="material-icons" aria-hidden="true">visibility</span> View Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- Featured books grid -->
    <section class="container featured-section">
        <h2 class="section-heading">
            <span class="material-icons" aria-hidden="true">favorite</span>
            Featured Books
        </h2>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php foreach ($books as $b):
                $title  = htmlspecialchars($b['title']);
                $author = htmlspecialchars($b['author']);
                $genre  = htmlspecialchars($b['genre']);
                $status = htmlspecialchars($b['status']);
                $img    = htmlspecialchars($b['image_path']);
                $price  = number_format((float)$b['price'], 2);
                $id     = (int)$b['book_id'];
            ?>
            <div class="col">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/<?php echo $img; ?>" class="card-img-top"
                         alt="<?php echo $title; ?> cover">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title"><?php echo $title; ?></h3>
                        <p class="card-meta"><?php echo $genre; ?> &middot; <?php echo $author; ?></p>
                        <p class="card-price">$<?php echo $price; ?></p>
                        <div class="mb-3">
                            <span class="badge status-<?php echo strtolower($status); ?>"><?php echo $status; ?></span>
                        </div>
                        <a href="details.php?id=<?php echo $id; ?>" class="btn btn-view-details mt-auto">
                            <span class="material-icons" aria-hidden="true">visibility</span> View Details
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.inc'; ?>