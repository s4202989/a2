<?php
include 'includes/db_connect.inc';

$page_title       = 'BookVerse | Browse Books';
$page_description = 'BookVerse is a simple book management website. Browse all books.';
$current_page     = 'books';

$sql = "SELECT book_id, title, author, genre, publication_year, price, status
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
        <span class="material-icons" aria-hidden="true">menu_book</span>
        All Books
    </h1>

    <!-- Filter bar -->
    <div class="filter-bar">
        <label for="statusFilter">Filter by Status:</label>
        <select id="statusFilter" class="form-select" aria-label="Filter books by status">
            <option value="all" selected>Show All</option>
            <option value="available">Available</option>
            <option value="reserved">Reserved</option>
            <option value="sold">Sold</option>
        </select>
    </div>

    <!-- Books table -->
    <div class="table-card">
        <table class="books-table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Year</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="booksTableBody">
                <?php foreach ($books as $b):
                    $status = htmlspecialchars($b['status']);
                ?>
                <tr data-status="<?php echo strtolower($status); ?>">
                    <td>
                        <a class="book-link" href="details.php?id=<?php echo (int)$b['book_id']; ?>">
                            <?php echo htmlspecialchars($b['title']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($b['author']); ?></td>
                    <td><?php echo htmlspecialchars($b['genre']); ?></td>
                    <td><?php echo htmlspecialchars((string)$b['publication_year']); ?></td>
                    <td>$<?php echo number_format((float)$b['price'], 2); ?></td>
                    <td><span class="badge status-<?php echo strtolower($status); ?>"><?php echo $status; ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>

<?php include 'includes/footer.inc'; ?>