<?php
include 'includes/db_connect.inc';

$page_title       = 'BookVerse | Gallery';
$page_description = 'BookVerse is a simple book management website. Book cover gallery.';
$current_page     = 'gallery';

$sql = "SELECT book_id, title, author, image_path
        FROM books
        ORDER BY book_id ASC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$books  = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

include 'includes/header.inc';
include 'includes/nav.inc';
?>

<main class="container page-content">

    <h1 class="section-heading">
        <span class="material-icons" aria-hidden="true">collections</span>
        Book Cover Gallery
    </h1>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
        <?php foreach ($books as $b):
            $title  = htmlspecialchars($b['title']);
            $author = htmlspecialchars($b['author']);
            $img    = 'assets/images/covers/' . htmlspecialchars($b['image_path']);
        ?>
        <div class="col">
            <button type="button" class="gallery-thumb-btn" data-bs-toggle="modal" data-bs-target="#galleryModal"
                data-title="<?php echo $title; ?>" data-author="<?php echo $author; ?>"
                data-image="<?php echo $img; ?>">
                <img src="<?php echo $img; ?>" alt="<?php echo $title; ?> cover" class="gallery-img">
            </button>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Gallery modal - content is filled in by JS when a thumbnail is clicked -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="galleryModalLabel">Book title by Author</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" id="prevBtn" class="btn btn-gallery-prev">
                        <span class="material-icons" aria-hidden="true">chevron_left</span> Previous
                    </button>
                    <button type="button" id="nextBtn" class="btn btn-gallery-next">
                        Next <span class="material-icons" aria-hidden="true">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</main>

<?php include 'includes/footer.inc'; ?>