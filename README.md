# COSC2446 Web Programming – Assessment 2
# BookVerse Online Bookstore Platform (Dynamic PHP/MySQL Version)

## Student Details

| Item | Details |
|---|---|
| Student name | Rahma Elsaify |
| Student ID | S4202989 |
| GitHub repository URL | https://github.com/s4202989/wp |
| Deployed website URL | TODO: add your Coreteaching URL |

---

## 1. Purpose of This README

This README documents the Assessment 2 project (the dynamic version of the Assessment 1 BookVerse website).

It is used to:

- summarise the project;
- explain the structure and technical choices;
- document testing and deployment;
- support marking of documentation and submission quality;
- help AI tools such as GitHub Copilot follow the assessment requirements.

---

## 2. Copilot and AI Coding Instructions

### My Copilot / AI instructions

- Use only PHP (procedural MySQLi), MySQL, HTML5, CSS3, Bootstrap 5.3.8, JavaScript, Google Fonts and Google Material Icons.
- Do not use frameworks or libraries such as jQuery, React, Vue, Laravel, PDO or any ORM.
- All database queries must use MySQLi prepared statements (`prepare`, `bind_param`, `execute`). Never put user input directly into an SQL string.
- Use one shared connection file, `includes/db_connect.inc`, which detects localhost or Coreteaching with `$_SERVER['SERVER_NAME']`.
- Keep the database password outside the repository (in `~/.htdb_pass` on the server). Never commit passwords.
- Use the shared includes (`header.inc`, `nav.inc`, `footer.inc`) on every page. Do not repeat the header, navbar or footer code in pages.
- Use exactly one stylesheet (`assets/css/style.css`) and one script file (`assets/js/scripts.js`). Load `scripts.js` once only (in `footer.inc`).
- No inline CSS (`style="..."`) and no inline JavaScript (`onclick="..."` and similar).
- Use the Bootstrap grid and components for layout and responsiveness (navbar, carousel, cards, table, modal).
- Escape all output with `htmlspecialchars()`.
- The `books` table and its column names must match the brief exactly.
- Form fields must use these names: `title`, `author`, `genre`, `publication_year`, `isbn`, `description`, `book_condition`, `price`, `image_path`, `status`, `agree`. Every field needs a label linked with `for`/`id`.
- Image uploads are limited to jpg, jpeg, png, gif and webp. Validate in JavaScript and again on the server. Show a preview with `FileReader` in the element with id `imagePreview`.
- The gallery must open a single Bootstrap modal with the full-size cover when a thumbnail is clicked.
- The books page must filter by All, Available, Reserved and Sold.
- Use meaningful page titles, semantic HTML, alt text on images and good colour contrast.
- Record meaningful AI use and debugging in `process-evidence.md`. Review and test all AI output and be able to explain it.

---

## 3. Project Overview

BookVerse is an online bookstore platform for readers who want to browse and buy books in an interactive way. In Assessment 2 the website is dynamic: the books are stored in a MySQL database and loaded with PHP instead of being typed into the HTML.

Users can view featured books in a carousel on the homepage (`index.php`), see all books with their availability in a filterable table (`books.php`), open a full details page for each book (`details.php`), browse the covers in an image gallery with a modal (`gallery.php`), and add a new book with a cover image (`add.php`, saved by `process_add.php`).

Technologies used: PHP, MySQL (MySQLi prepared statements), HTML5, CSS3, Bootstrap 5.3.8 and JavaScript.

This is a **dynamic** website, with data read from and written to a database.

---

## 4. Website Structure

| File | Purpose |
|---|---|
| `index.php` | Homepage with a carousel and featured book listings loaded from the database |
| `books.php` | Table of all books with availability and a status filter |
| `details.php` | Full details of one book, loaded with `details.php?id=<book_id>` |
| `gallery.php` | Responsive cover gallery with a Bootstrap image modal |
| `add.php` | Form to add a new book with image validation and preview |
| `process_add.php` | Server-side validation, image upload and prepared INSERT, then redirect to the new book's details page |
| `includes/db_connect.inc` | Database connection (works on localhost and Coreteaching) |
| `includes/header.inc` | Shared `<head>`, fonts, icons and CSS |
| `includes/nav.inc` | Shared Bootstrap navbar with active-page highlighting |
| `includes/footer.inc` | Shared footer, Bootstrap JS and `scripts.js` (loaded once) |
| `bookverse.sql` | Creates the `books` table and inserts 12 sample books |

---

## 5. Project Folder Structure

```text
a2/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       ├── favicon.svg
│       └── covers/
├── includes/
│   ├── db_connect.inc
│   ├── header.inc
│   ├── nav.inc
│   └── footer.inc
├── index.php
├── books.php
├── details.php
├── gallery.php
├── add.php
├── process_add.php
├── bookverse.sql
├── README.md
└── process-evidence.md
```

Note: the files inside `assets/images/covers/` are not tracked by Git. They are copied to the server by hand.

---

## 6. Technologies Used

| Technology | How it was used in this project |
|---|---|
| HTML5 | Semantic structure with `<header>`, `<nav>`, `<main>` and `<footer>` |
| CSS3 | Custom styling in one file, `assets/css/style.css` (no inline styles) |
| Bootstrap 5.3.8 | Responsive grid, navbar, carousel, cards, table, modal and form styling |
| JavaScript | Status filter, gallery modal, image validation and image preview in `assets/js/scripts.js` |
| PHP | Builds each page, reads the database, validates the form on the server, handles the image upload |
| MySQL / MySQLi | `books` table; all queries use prepared statements |
| Google Fonts | Headings: Righteous, body text: Elms Sans |
| Material Icons | Icons in the navbar, buttons and cards |
| XAMPP | Local testing on Windows (Apache and MySQL) |
| GitHub | Repository cloned from the instructor's starter repo; my updated pages added to `a2` |
| Coreteaching server | Deployment (Apache, PHP and the Jacob 5 MySQL database) |
| AI tools | Claude (and ChatGPT, if used. TODO: delete if not used) |

---

## 7. Design and Layout

The site uses a **Teal & Amber** theme.

**Brand colours**

- Primary: `#0d9488`
- Primary dark: `#0f766e`
- Primary light: `#14b8a6`
- Secondary: `#d97706`
- Secondary dark: `#b45309`

**Accent colours**

- Accent amber: `#fbbf24`
- Accent green: `#10b981`
- Accent slate: `#475569`

**Neutral colours**

- Text dark: `#1f2937`
- Text light: `#6b7280`
- Background light: `#f9fafb`
- Background white: `#ffffff`
- Border: `#e5e7eb`

The colours are stored as CSS variables in `:root` in `style.css` and reused across the site. Status badges use colour to show availability (Available, Reserved, Sold).

**Fonts:** Headings use Righteous and body text uses Elms Sans, both loaded from Google Fonts in `header.inc`.

**Icons:** Google Material Icons, for example `<span class="material-icons" aria-hidden="true">menu_book</span>`.

**Bootstrap:** the grid system (`container`, `row`, `row-cols-*`, `col`) divides each page into responsive components. The layout changes between phone, tablet and desktop widths, and the navbar collapses into a toggle button on small screens.

---

## 8. Required Features

| Feature | Page | Explanation |
|---|---|---|
| Carousel | `index.php` | Rotating slides of the latest books, loaded from the database |
| Responsive book layout | `index.php` | Featured books shown as Bootstrap cards in a responsive grid |
| Book table | `books.php` | Structured table of all books with author, genre, year, price and status |
| Status filter | `books.php` | Filter control for All / Available / Reserved / Sold, handled in JavaScript |
| Book details | `details.php` | One book loaded by `id` using a prepared statement |
| Gallery grid | `gallery.php` | Covers in a responsive Bootstrap grid |
| Bootstrap image modal | `gallery.php` | Clicking a cover opens a modal with the full-size image |
| Add Book form | `add.php` | Form that collects new book details |
| Image validation | `add.php`, `process_add.php` | Extension checked in JavaScript and again on the server |
| Image preview | `add.php` | `FileReader` API shows the selected image in `#imagePreview` |
| Database insert | `process_add.php` | Prepared INSERT, then redirect to the new book's details page |

---

## 9. JavaScript Functionality

| JavaScript feature | Page | How it works |
|---|---|---|
| Image extension validation | `add.php` | When a file is chosen, its extension is checked against the allowed list (jpg, jpeg, png, gif, webp) |
| Image preview | `add.php` | After a valid file is chosen, a `FileReader` calls `readAsDataURL(file)` and the result is set as the `src` of `#imagePreview` |
| Gallery modal | `gallery.php` | Each thumbnail button has a click listener that puts the image and title into the single modal |
| Book status filter | `books.php` | The filter control's change event shows or hides table rows using each row's `data-status` value |

All JavaScript is in `assets/js/scripts.js`. There is no inline JavaScript.

---

## 10. Form Validation

**Required fields**

- Book Title: `title`
- Author Name: `author`
- Genre: `genre`
- Publication Year: `publication_year`
- ISBN: `isbn`
- Description: `description`
- Book Condition: `book_condition` (New, Gently Used, Fair)
- Price: `price`
- Upload Cover Image: `image_path`
- Status: `status` (Available, Reserved, Sold)
- "I agree that this book information is accurate and complete": `agree`

**Labels:** each field has a `<label for="...">` that matches the input's `id`, for example:

```html
<label for="book-title" class="form-label">Title</label>
<input type="text" id="book-title" name="title" class="form-control" required>
```

**Input types used**

- `type="text"` for title, author and ISBN
- `type="number"` for publication year and price
- `<textarea>` for the description
- `<select>` for genre, condition and status (a fixed list of valid options)
- `type="file"` for the cover image (`name="image_path"`) with `accept="image/jpeg,image/png,image/gif,image/webp"`
- `type="checkbox"` for the agreement

**Image file check:** the `accept` attribute and a JavaScript extension check run in the browser. The server then checks the extension again, checks the file is a real image with `getimagesize()`, limits the size to 5 MB and saves it under a unique filename.

**Accepted extensions:** jpg, jpeg, png, gif, webp.

**Image preview:** once a file passes validation, `scripts.js` creates a `FileReader`, calls `readAsDataURL(file)` and sets the `src` of `#imagePreview` in its `load` event.

**Feedback if the file is invalid:** TODO: write what your page shows (for example, the message text and where it appears) after you test it.

**Server-side validation:** `process_add.php` trims and checks every field, checks the ENUM values (condition and status), checks price and year, and uses a prepared INSERT. If something is wrong, the user is sent back to `add.php` with an error message.

---

## 11. Accessibility and Usability

- Meaningful `<title>` on every page (set per page in `header.inc`)
- Semantic HTML (`header`, `nav`, `main`, `footer`)
- Every form field has an associated `<label>`
- Images have alt text, and decorative icons use `aria-hidden="true"`
- Consistent navigation on every page, with the current page highlighted
- Readable text and good colour contrast (TODO: confirm with a contrast checker)
- Responsive layout, including a collapsing mobile navbar
- Clear user feedback (error alerts on the form, a "book not found" message on the details page)

---

## 12. Testing and Validation

Complete this section after testing. Do not leave a result as "Pass" unless you ran the check.

### HTML Validation

| File | Result | Notes |
|---|---|---|
| `index.php` | TODO: Pass / Issues found | TODO |
| `books.php` | TODO: Pass / Issues found | TODO |
| `details.php?id=1` | TODO: Pass / Issues found | TODO |
| `gallery.php` | TODO: Pass / Issues found | TODO |
| `add.php` | TODO: Pass / Issues found | TODO |

(Validate the generated HTML, e.g. by pasting the page source into the W3C validator.)

### CSS Validation

| File | Result | Notes |
|---|---|---|
| `assets/css/style.css` | TODO: Pass / Issues found | TODO |

### Functionality Testing

| Feature tested | Result | Notes |
|---|---|---|
| Navigation links | TODO | TODO |
| Carousel loads books from the database | TODO | TODO |
| Details page (`details.php?id=1`) | TODO | TODO |
| Gallery modal | TODO | TODO |
| Book status filter (All / Available / Reserved / Sold) | TODO | TODO |
| Add Book form validation | TODO | TODO |
| Image preview | TODO | TODO |
| New book saved to the database | TODO | TODO |
| Mobile navbar toggle | TODO | TODO |
| Localhost (XAMPP) | TODO | TODO |
| Deployed site links, assets and database | TODO | TODO |

---

## 13. Deployment

| Item | Details |
|---|---|
| Deployed website URL | TODO |
| Coreteaching server | TODO: server name |
| Deployment folder | TODO: e.g. `~/public_html/wp/a2` |
| `.htaccess` location | `public_html` (not inside `a2`) |
| Database | Jacob 5 MySQL. TODO: confirm DB name and username |
| Database password | Stored in `~/.htdb_pass` outside the repository (not committed) |

Deployment steps used: `git pull` on the server, `chmod 755 a2`, `chmod 777 a2/assets/images/covers`, cover images copied by hand, `bookverse.sql` imported into the Jacob 5 database (with the `CREATE DATABASE` and `USE` lines commented out).

TODO: In 2–4 sentences, explain how you checked that the deployed website works correctly (for example, which pages you opened, whether the books and images appeared, and whether adding a book worked).

---

## 14. Git and Development Process

TODO: Fill in with what is true for your repository. Check with `git log --date=short --pretty="%ad %s"`.

- How often I committed: TODO (number of commits and on how many different days)
- Types of changes in my commits: TODO (e.g. includes, database file, each page, fixes for bugs)
- How the history shows progressive development: TODO
- How my commits relate to my process-evidence records: TODO (each debugging record links to the commit that fixed it)

Note: commits are made as I work and are not backdated.

---

## 15. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:
- [yes] I used AI tools meaningfully during this assessment.
- [yes] I recorded meaningful AI use in `process-evidence.md`.
- [yes] I reviewed, tested, and adapted AI-assisted output.
- [yes] I can explain all AI-assisted code submitted.

I used Claude to help convert my Assessment 1 pages into PHP pages, to design the `books` table, to write the database connection and the prepared statements, and to work out errors while setting up XAMPP, Git and the Jacob 5 database. I tested the code myself, fixed the problems that came up, and changed parts to match my design. TODO: edit these sentences so they describe exactly what you did and checked.

Detailed AI usage records are in `process-evidence.md`.

---

## 16. Process Evidence

| Requirement | Completed? |
|---|---|
| `process-evidence.md` file included | TODO: Yes / No |
| At least 4 debugging records included (7 fields each) | TODO: Yes / No |
| At least 4 meaningful AI usage records included (7 fields each) | TODO: Yes / No |
| Relevant commit links included | TODO: Yes / No |

---

## 17. Known Issues or Limitations

| Issue or limitation | Explanation |
|---|---|
| Cover images are not in Git | `assets/images/covers/*` is git-ignored, so images must be copied to the server by hand |
| TODO | TODO: add anything that is not working when you finish testing |

If there are no known issues, replace the table with:

> No known issues at the time of submission.