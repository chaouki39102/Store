const fileInput = document.querySelector("[data-preview]");
if (fileInput) {
    const imgPreview = document.getElementById(fileInput.dataset.preview);
    fileInput.addEventListener("change", () => {
        imgPreview.src = window.URL.createObjectURL(fileInput.files[0]);
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("images");
    const previewContainer = document.getElementById("image-preview");
    const imageCounter = document.getElementById("image-counter");

    input.addEventListener("change", function () {
        const files = input.files;
        for (let i = 0; i < files.length; i++) {
            if (files[i].type.match("image.*")) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create a container for each image with a delete button
                    const imageContainer = document.createElement("div");
                    imageContainer.classList.add("image-container");

                    // Create an image element
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("preview-image");

                    // Create a delete button for each image
                    const deleteButton = document.createElement("button");
                    deleteButton.textContent = "Delete";
                    deleteButton.classList.add("delete-button");
                    deleteButton.dataset.index = i; // Store the index for identification
                    deleteButton.addEventListener("click", function () {
                        // Remove the image and the delete button when clicked
                        imageContainer.remove();
                        updateImageCounter();
                    });

                    // Append image and delete button to the container
                    imageContainer.appendChild(img);
                    imageContainer.appendChild(deleteButton);

                    // Append the container to the preview container
                    previewContainer.appendChild(imageContainer);

                    updateImageCounter();
                };

                reader.readAsDataURL(files[i]);
            }
        }
    });

    function updateImageCounter() {
        const imageCount =
            previewContainer.querySelectorAll(".image-container").length;
        imageCounter.textContent = `Selected Images: ${imageCount}`;
    }
});
