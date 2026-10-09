<?php
$page_title       = 'BookVerse | Add Book';
$page_description = 'BookVerse is a simple book management website. Add a new book.';
$current_page     = 'add';

// process_add.php sends the user back here with ?error=... if something is wrong
$error = isset($_GET['error']) ? $_GET['error'] : '';

include 'includes/header.inc';
include 'includes/nav.inc';
?>

<main class="container page-content">

    <h1 class="section-heading">
        <span class="material-icons" aria-hidden="true">add_circle</span>
        Add New Book
    </h1>

    <?php if ($error !== ''): ?>
    <div class="alert alert-danger form-alert" role="alert">
        <span class="material-icons" aria-hidden="true">error_outline</span>
        <?php echo htmlspecialchars($error); ?>
    </div>
    <?php endif; ?>

    <div class="form-card">
        <form id="addBookForm" action="process_add.php" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="title" class="form-label">
                    <span class="material-icons" aria-hidden="true">menu_book</span> Book Title
                </label>
                <input type="text" class="form-control" id="title" name="title" maxlength="255"
                    placeholder="Enter book title" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">
                    <span class="material-icons" aria-hidden="true">person</span> Author Name
                </label>
                <input type="text" class="form-control" id="author" name="author" maxlength="255"
                    placeholder="Enter author name" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">
                    <span class="material-icons" aria-hidden="true">category</span> Genre
                </label>
                <select class="form-select" id="genre" name="genre" required>
                    <option value="" selected disabled>Select a genre</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Romance">Romance</option>
                    <option value="Dystopian">Dystopian</option>
                    <option value="Memoir">Memoir</option>
                    <option value="Self-Help">Self-Help</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Biography">Biography</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="publicationYear" class="form-label">
                        <span class="material-icons" aria-hidden="true">event</span> Publication Year
                    </label>
                    <input type="number" class="form-control" id="publicationYear" name="publication_year"
                        placeholder="2024" min="1000" max="2026" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">
                        <span class="material-icons" aria-hidden="true">attach_money</span> Price ($)
                    </label>
                    <input type="number" class="form-control" id="price" name="price"
                        placeholder="19.99" min="0" step="0.01" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">
                        <span class="material-icons" aria-hidden="true">tag</span> ISBN
                    </label>
                    <input type="text" class="form-control" id="isbn" name="isbn" maxlength="20"
                        placeholder="978-1-234567-89-0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bookCondition" class="form-label">
                        <span class="material-icons" aria-hidden="true">verified</span> Book Condition
                    </label>
                    <select class="form-select" id="bookCondition" name="book_condition" required>
                        <option value="" selected disabled>Select condition</option>
                        <option value="New">New</option>
                        <option value="Gently Used">Gently Used</option>
                        <option value="Fair">Fair</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">
                    <span class="material-icons" aria-hidden="true">description</span> Description
                </label>
                <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Describe the book..." required></textarea>
            </div>

            <div class="mb-2">
                <label for="imagePath" class="form-label">
                    <span class="material-icons" aria-hidden="true">upload_file</span> Upload Cover Image
                </label>
                <input type="file" class="form-control" id="imagePath" name="image_path"
                    accept=".jpg,.jpeg,.png,.gif,.webp" required>
            </div>
            <p id="fileSelectedMsg" class="file-selected-msg"></p>
            <div id="imagePreviewWrap" class="image-preview-wrap">
                <img id="imagePreview" src="" alt="Cover preview" class="image-preview">
            </div>

            <div class="mb-3 mt-3">
                <label for="status" class="form-label">
                    <span class="material-icons" aria-hidden="true">inventory_2</span> Availability Status
                </label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Available" selected>Available</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Sold">Sold</option>
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                <label class="form-check-label" for="agree">
                    I agree that this book information is accurate and complete
                </label>
            </div>

            <button type="submit" class="btn btn-submit-book w-100">
                <span class="material-icons" aria-hidden="true">add_circle</span> Add Book to Collection
            </button>

        </form>
    </div>

</main>

<?php include 'includes/footer.inc'; ?>