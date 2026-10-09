<?php
// Each page sets $page_title (and optionally $page_description) before including this file
$page_title       = $page_title ?? 'BookVerse';
$page_description = $page_description ?? 'BookVerse is a simple book management website.';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="author" content="Rahma Elsaify">
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">

    <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Elms+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Bootstrap CSS (JavaScript is loaded once, in footer.inc) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Custom CSS (single file) -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>