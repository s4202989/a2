<?php
include 'includes/db_connect.inc';

// Send the user back to the form with a message
function back_with_error($message)
{
    header('Location: add.php?error=' . urlencode($message));
    exit;
}

// Only accept form submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit;
}

// 1. Read and clean the text fields
$title       = trim($_POST['title'] ?? '');
$author      = trim($_POST['author'] ?? '');
$genre       = trim($_POST['genre'] ?? '');
$isbn        = trim($_POST['isbn'] ?? '');
$description = trim($_POST['description'] ?? '');
$condition   = $_POST['book_condition'] ?? '';
$status      = $_POST['status'] ?? '';
$year        = ($_POST['publication_year'] ?? '') === '' ? null : (int)$_POST['publication_year'];
$price       = (float)($_POST['price'] ?? 0);

// 2. Validate on the server (JavaScript checks can be bypassed)
if ($title === '' || $author === '' || $genre === '' || $description === '') {
    back_with_error('Please fill in all required fields.');
}
if (!in_array($condition, ['New', 'Gently Used', 'Fair'], true)) {
    back_with_error('Invalid book condition.');
}
if (!in_array($status, ['Available', 'Reserved', 'Sold'], true)) {
    back_with_error('Invalid status.');
}
if ($price < 0) {
    back_with_error('Price cannot be negative.');
}
if ($year !== null && ($year < 1000 || $year > 2100)) {
    back_with_error('Please enter a valid publication year.');
}
if ($isbn === '') {
    $isbn = null;
}

// 3. Check the uploaded image
if (!isset($_FILES['image_path']) || $_FILES['image_path']['error'] !== UPLOAD_ERR_OK) {
    back_with_error('Please choose a cover image to upload.');
}

$original  = $_FILES['image_path']['name'];
$tmp_path  = $_FILES['image_path']['tmp_name'];
$extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));

if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
    back_with_error('Only JPG, PNG, GIF or WEBP images are allowed.');
}
if (getimagesize($tmp_path) === false) {
    back_with_error('The uploaded file is not a real image.');
}
if ($_FILES['image_path']['size'] > 5 * 1024 * 1024) {
    back_with_error('The image must be smaller than 5 MB.');
}

// 4. Save the image with a unique name so nothing is overwritten
$new_name = uniqid('cover_', true) . '.' . $extension;
$target   = 'assets/images/covers/' . $new_name;

if (!move_uploaded_file($tmp_path, $target)) {
    back_with_error('Could not save the image. Please try again.');
}

// 5. Insert the book (prepared statement)
$sql = "INSERT INTO books
            (title, author, genre, publication_year, isbn, description,
             book_condition, price, image_path, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

try {
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        'sssisssdss',
        $title, $author, $genre, $year, $isbn, $description,
        $condition, $price, $new_name, $status
    );
    mysqli_stmt_execute($stmt);
    $new_id = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);
} catch (mysqli_sql_exception $e) {
    unlink($target); // do not leave an orphan image behind
    back_with_error('Sorry, the book could not be saved.');
}

// 6. Show the new book
header('Location: details.php?id=' . $new_id);
exit;