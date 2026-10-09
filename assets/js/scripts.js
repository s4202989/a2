/* ===== Books page: status filter ===== */
const statusFilter = document.getElementById('statusFilter');

if (statusFilter) {
    statusFilter.addEventListener('change', function () {
        const selectedStatus = statusFilter.value;
        const rows = document.querySelectorAll('#booksTableBody tr');

        rows.forEach(function (row) {
            const matches = (selectedStatus === 'all' || row.dataset.status === selectedStatus);
            row.style.display = matches ? '' : 'none';
        });
    });
}

/* ===== Gallery page: modal viewer with Previous / Next ===== */
const galleryThumbs = document.querySelectorAll('.gallery-thumb-btn');
const modalImage = document.getElementById('modalImage');
const modalTitleEl = document.getElementById('galleryModalLabel');
let currentGalleryIndex = 0;

if (galleryThumbs.length > 0 && modalImage) {

    function showGalleryItem(index) {
        // wrap around so Next on the last cover loops back to the first (and vice versa)
        if (index < 0) index = galleryThumbs.length - 1;
        if (index >= galleryThumbs.length) index = 0;
        currentGalleryIndex = index;

        const thumb = galleryThumbs[currentGalleryIndex];
        modalImage.src = thumb.dataset.image;
        modalImage.alt = thumb.dataset.title + ' cover';
        modalTitleEl.textContent = thumb.dataset.title + ' by ' + thumb.dataset.author;
    }

    galleryThumbs.forEach(function (thumb, index) {
        thumb.addEventListener('click', function () {
            showGalleryItem(index);
        });
    });

    document.getElementById('prevBtn').addEventListener('click', function () {
        showGalleryItem(currentGalleryIndex - 1);
    });

    document.getElementById('nextBtn').addEventListener('click', function () {
        showGalleryItem(currentGalleryIndex + 1);
    });
}

/* ===== Add Book page: image extension check + live preview ===== */
const imageInput = document.getElementById('imagePath');
const fileSelectedMsg = document.getElementById('fileSelectedMsg');
const imagePreviewWrap = document.getElementById('imagePreviewWrap');
const imagePreview = document.getElementById('imagePreview');
const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

if (imageInput) {
    imageInput.addEventListener('change', function () {
        const file = imageInput.files[0];

        // reset previous state on every new selection
        fileSelectedMsg.textContent = '';
        fileSelectedMsg.className = 'file-selected-msg';
        imagePreviewWrap.style.display = 'none';
        imagePreview.src = '';

        if (!file) {
            return;
        }

        const extension = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(extension)) {
            fileSelectedMsg.textContent = 'Please choose a JPG, PNG, GIF, or WEBP image.';
            fileSelectedMsg.className = 'file-selected-msg file-error';
            imageInput.value = ''; // clear the invalid file so it can't be submitted
            return;
        }

        fileSelectedMsg.textContent = 'Selected: ' + file.name;
        fileSelectedMsg.className = 'file-selected-msg file-success';

        // Live preview: read the file into a data URL and show it
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreviewWrap.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });
}

/* ===== Add Book page: form submit (Stage 1 is static, so we just validate) ===== */
const addBookForm = document.getElementById('addBookForm');

if (addBookForm) {
    addBookForm.addEventListener('submit', function (event) {
        event.preventDefault(); // no backend yet - stop the browser from trying to send this anywhere

        const formFeedback = document.getElementById('formFeedback');

        if (!addBookForm.checkValidity()) {
            addBookForm.reportValidity(); // shows the browser's built-in validation messages
            formFeedback.textContent = '';
            return;
        }

        formFeedback.textContent = 'Book details validated successfully. (Static demo - nothing is saved yet.)';
        formFeedback.className = 'form-feedback form-feedback-success';
    });
}