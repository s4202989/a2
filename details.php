<?php
include 'includes/db_connect.inc';

// Read and validate the id from the URL: details.php?id=3
$id   = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$book = null;

if ($id) {
    $sql = "SELECT title, author, genre, publication_year, isbn, description,
                   book_condition, price, image_path, status
            FROM books
            WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $book   = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

$page_title       = ($book ? $book['title'] : 'Book not found') . ' | BookVerse';
$page_description = 'BookVerse is a simple book management website. Book details page.';
$current_page     = 'books';

include 'includes/header.inc';
include 'includes/nav.inc';
?>

<main class="container page-content">

<?php if (!$book): ?>

    <div class="alert alert-warning" role="alert">
        <span class="material-icons" aria-hidden="true">error_outline</span>
        Sorry, that book could not be found.
    </div>
    <a href="books.php" class="btn btn-back">
        <span class="material-icons" aria-hidden="true">arrow_back</span> Back to Books
    </a>

<?php else:
    $title  = htmlspecialchars($book['title']);
    $status = htmlspecialchars($book['status']);
?>

    <div class="row g-4">
        <div class="col-md-4">
            <img src="assets/images/covers/<?php echo htmlspecialchars($book['image_path']); ?>"
                 class="details-cover" alt="<?php echo $title; ?> cover">
        </div>

        <div class="col-md-8">
            <h1 class="details-title"><?php echo $title; ?></h1>
            <p class="details-author">by <?php echo htmlspecialchars($book['author']); ?></p>
            <span class="badge status-<?php echo strtolower($status); ?>"><?php echo $status; ?></span>

            <div class="details-card">
                <dl class="row mb-0">
                    <dt class="col-sm-4"><span class="material-icons" aria-hidden="true">category</span> Genre</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($book['genre']); ?></dd>

                    <dt class="col-sm-4"><span class="material-icons" aria-hidden="true">event</span> Publication Year</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars((string)$book['publication_year']); ?></dd>

                    <dt class="col-sm-4"><span class="material-icons" aria-hidden="true">tag</span> ISBN</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars((string)$book['isbn']); ?></dd>

                    <dt class="col-sm-4"><span class="material-icons" aria-hidden="true">verified</span> Condition</dt>
                    <dd class="col-sm-8"><?php echo htmlspecialchars($book['book_condition']); ?></dd>

                    <dt class="col-sm-4"><span class="material-icons" aria-hidden="true">sell</span> Price</dt>
                    <dd class="col-sm-8 details-price">$<?php echo number_format((float)$book['price'], 2); ?></dd>
                </dl>
            </div>

            <h2 class="details-subheading">Description</h2>
            <p class="details-description"><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="books.php" class="btn btn-back">
                    <span class="material-icons" aria-hidden="true">arrow_back</span> Back to Books
                </a>
                <a href="add.php" class="btn btn-add-similar">
                    <span class="material-icons" aria-hidden="true">add_circle</span> Add Similar Book
                </a>
            </div>
        </div>
    </div>

<?php endif; ?>

</main>

<?php include 'includes/footer.inc'; ?>