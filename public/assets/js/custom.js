(function (root, factory) {
    "use strict";

    const windowObject = root;

    if (typeof define === "function" && define.amd) {
        const initFunction = function () {
            windowObject.ImageUploader = factory();
            return root.ImageUploader;
        };

        define([], initFunction);
    } else {
        windowObject.ImageUploader = factory();
    }
})(window, () => {
    "use strict";

    /**
     * @type {File}
     * Creating an empty array that stores in memory the images selected by the user.
     * For more information @see {@link https://developer.mozilla.org/en-US/docs/Web/API/File|MDN}.
     */
    const imageFiles = [];

    /**
     * Creating an object with the configurations that are going to be used for validations.
     */
    const configurations = {
        fileTypeValidationRegex: null,
        maxImageHeight: null,
        maxImageWidth: null,
        maxFilesQuantity: 5,
        maxFileSize: 8,
        minImageHeight: 100,
        minImageWidth: 100,
    };

    /**
     * Creating an object to store the references to the HTML Elements for the Image Uploader UX.
     */
    const htmlElements = {
        component: null,
        contentWrapper: null,
        dropArea: null,
        errorMessages: null,
        imagePreviewContainer: null,
        imagePreviewTemplate: null,
        inputFile: null,
        thumbnailsContainer: null,
        uploadButton: null,
    };

    /**
     * If the image is too big or too small, return false, otherwise return true.
     *
     * @param {number} width - The width of the image in pixels.
     * @param {number} height - The height of the image in pixels.
     * @returns true if the image has the valid dimensions according to the configuration object
     * otherwise false.
     */
    function hasValidDimensions(width, height) {
        const hasMaxWidthValidation = Number.isInteger(
            configurations.maxImageWidth
        );
        const hasMaxHeightValidation = Number.isInteger(
            configurations.maxImageHeight
        );
        const hasMinWidthValidation = Number.isInteger(
            configurations.minImageWidth
        );
        const hasMinHeightValidation = Number.isInteger(
            configurations.minImageHeight
        );

        if (hasMaxWidthValidation && width > configurations.maxImageWidth) {
            return false;
        }

        if (hasMaxHeightValidation && height > configurations.maxImageHeight) {
            return false;
        }

        if (hasMinWidthValidation && width < configurations.minImageWidth) {
            return false;
        }

        if (hasMinHeightValidation && height < configurations.minImageHeight) {
            return false;
        }

        return true;
    }

    /**
     * If the number of files in the imageFiles array is greater than or equal to the maxFilesQuantity
     * value in the configurations object, then disable the upload button and add the disable class to
     * the contentWrapper element. Otherwise, enable the upload button and remove the disable class from
     * the contentWrapper element.
     *
     * @returns the value of the disabled property of the uploadButton element.
     */
    function isMaxQuantityFilesReached() {
        if (imageFiles.length >= configurations.maxFilesQuantity) {
            htmlElements.uploadButton.disabled = true;
            htmlElements.contentWrapper.classList.add("disable");
        } else {
            htmlElements.uploadButton.disabled = false;
            htmlElements.contentWrapper.classList.remove("disable");
        }

        return htmlElements.uploadButton.disabled;
    }

    /**
     * Add the image to the imageFiles array if the max quantity of files has not been reached and
     * the image has valid dimensions, otherwise show an error message.
     *
     * If the image is consider valid appends the fragment to the imagePreviewContainer element to let
     * the user see the preview of the image uploaded.
     *
     * @param {File} image - the image file that was selected by the user.
     * @returns the image file if it is considered valid, otherwise null.
     */
    function acceptImage(image) {
        const fragment = this;
        const imageElement = fragment.querySelector("img");

        if (
            isMaxQuantityFilesReached() ||
            !hasValidDimensions(imageElement.width, imageElement.height)
        ) {
            htmlElements.errorMessages.classList.remove("hidden");
            return null;
        }

        imageFiles.push(image);
        htmlElements.imagePreviewContainer.appendChild(fragment);
        htmlElements.thumbnailsContainer.classList.remove("hidden");

        // Review if the new added image reaches the limit for the max amount of quantity files allowed.
        isMaxQuantityFilesReached();
        return image;
    }

    /**
     * It's a function that when called, will trigger a click event on the input file element.
     * This is used to open the File Selector dialog when the user clicks the uploadButton element.
     */
    function clickInputFile() {
        htmlElements.inputFile.click();
    }

    /**
     * It converts the file size from bytes to Mega Bytes and returns true if the file size is greater
     * than the max file size
     * @param file - The file that is being uploaded.
     * @returns a boolean value.
     */
    function isMaxFileSizeExceeded(file) {
        // Converts the file size from bytes to Mega Bytes.
        const fileSize = file.size / 1024 / 1024;
        return fileSize > configurations.maxFileSize;
    }

    /**
     * When the user selects an image to upload, read and load the image in the memory
     * and trigger the validations processes from @see acceptImage.
     * @param {File} imageFile - The file that is being uploaded by the user.
     */
    function loadImage(imageFile) {
        const reader = new FileReader();
        reader.readAsDataURL(imageFile);
        reader.onload = function () {
            const fragment = document
                .createRange()
                .createContextualFragment(
                    htmlElements.imagePreviewTemplate.innerHTML
                );
            const imageElement = fragment.querySelector("img");

            fragment.querySelector(
                "[data-image-preview-element]"
            ).dataset.index = imageFiles.length - 1;
            imageElement.onload = acceptImage.bind(fragment, imageFile);
            imageElement.src = reader.result;
        };
    }

    /**
     * Walks through the images selected by the user and performs the validations that don't need
     * the image to be loaded in memory.
     *
     * If the file does not meet the regex expression defined in the configurations object,
     * or if the file is too large, display an error message.
     *
     * @param imagesUploaded - An array of files that were uploaded.
     */
    function readImages(imagesUploaded) {
        htmlElements.errorMessages.classList.add("hidden");

        for (let index = 0; index < imagesUploaded.length; index += 1) {
            const image = imagesUploaded[index];
            const isInvalidFileSize = isMaxFileSizeExceeded(image);
            const isInvalidFileType =
                configurations.fileTypeValidationRegex &&
                !configurations.fileTypeValidationRegex.exec(image.name);

            if (isInvalidFileType || isInvalidFileSize) {
                htmlElements.errorMessages.classList.remove("hidden");
            } else {
                loadImage(image);
            }
        }
    }

    /**
     * When a file is dragged over the drop zone HTML element, prevent the default behavior and allow the file to be
     * copied.
     * @param {Event} event - The event object that is passed to the function.
     */
    function onDragOver(event) {
        const eventObject = event;
        event.stopPropagation();
        event.preventDefault();
        eventObject.dataTransfer.dropEffect = "copy";
    }

    /**
     * When the user drops a file on the drop zone HTML element stops the default browser behavior,  which is to open
     * the file in the browser window. The function then calls the @see readImages function, passing it the files that
     * were dropped.
     *
     * @param {Event} event - The event object that is passed to the function.
     */
    function onDrop(event) {
        event.stopPropagation();
        event.preventDefault();
        readImages(event.dataTransfer.files);
    }

    /**
     * A function that is called when the user selects the images via the uploadButton HTML element.
     * The function then calls the @see readImages function, passing it the files that were dropped.
     *
     * @param event - The event object that is passed to the function.
     */
    function onImagesUploaded(event) {
        const eventObject = event;
        readImages(event.target.files);
        eventObject.target.value = null;
    }

    /**
     * Set the data attibute index to each preview HTML element matching its position in the HTML.
     * This function is called after the @see removeImage function is invoked.
     * If there are no previews, hide the thumbnailsContainer HTML element.
     */
    function resetPreviewIndexes() {
        const previews = document.querySelectorAll(
            "[data-image-preview-element]"
        );

        if (previews.length === 0) {
            htmlElements.thumbnailsContainer.classList.add("hidden");
        }

        for (let index = 0; index < previews.length; index += 1) {
            previews[index].dataset.index = index;
        }
    }

    /**
     * Removes the image from the @see imageFiles array and the DOM. Then resets the index
     * data attribute for the remaining preview images and updates the status of the image uploader
     * by checking if the max quantity of files allowed has been reached.
     *
     * @param {Event} event - The event object that is passed to the function
     * @returns the event.target.closest('[data-removal-button]');
     */
    function removeImage(event) {
        const removalButton = event.target.closest("[data-removal-button]");

        if (!removalButton) {
            return null;
        }

        const previewToRemove = removalButton.closest(
            "[data-image-preview-element]"
        );
        const imageRemoved = imageFiles.splice(
            previewToRemove.dataset.index,
            1
        );

        previewToRemove.remove();
        resetPreviewIndexes();
        isMaxQuantityFilesReached();

        return imageRemoved;
    }

    /**
     * Adds event listeners to the upload button, the input file, the thumbnails container, and the drop area.
     */
    function addEventListeners() {
        htmlElements.uploadButton.addEventListener("click", clickInputFile);
        htmlElements.inputFile.addEventListener("change", onImagesUploaded);
        htmlElements.thumbnailsContainer.addEventListener("click", removeImage);
        htmlElements.dropArea.addEventListener("dragover", onDragOver);
        htmlElements.dropArea.addEventListener("drop", onDrop);
    }

    /**
     * Sets the @see htmlElements object's properties to the elements within the component.
     *
     * @param {Element} root - The root element of the image uploader component.
     */
    function setHtmlElements(root) {
        htmlElements.component = root;
        htmlElements.contentWrapper = root.querySelector(
            "[data-image-uploader-content]"
        );
        htmlElements.dropArea = root.querySelector(
            "[data-image-uploader-drop-area]"
        );
        htmlElements.errorMessages = root.querySelector(
            "[data-image-uploader-errors]"
        );
        htmlElements.imagePreviewContainer = root.querySelector(
            "[data-image-preview-container]"
        );
        htmlElements.imagePreviewTemplate = root.querySelector(
            "[data-image-preview]"
        );
        htmlElements.inputFile = root.querySelector("input");
        htmlElements.thumbnailsContainer = root.querySelector(
            "[data-thumbnails-container]"
        );
        htmlElements.uploadButton = root.querySelector("button");
    }

    /**
     * Reads the data attributes from the image uploader component HTML element and sets the @see configurations object.
     *
     * @param {Element} root - The root element of the image uploader component.
     */
    function setImageUploaderConfigurations(root) {
        const temporalConfigurations = {};
        temporalConfigurations.maxFilesQuantity =
            root.dataset.imageUploaderMaxFilesQuantity * 1;
        temporalConfigurations.maxFileSize =
            root.dataset.imageUploaderMaxFileSize * 1;
        temporalConfigurations.maxImageHeight = root.dataset.maxImageHeight * 1;
        temporalConfigurations.maxImageWidth = root.dataset.maxImageWidth * 1;
        temporalConfigurations.minImageHeight = root.dataset.minImageHeight * 1;
        temporalConfigurations.minImageWidth = root.dataset.minImageWidth * 1;

        Object.keys(temporalConfigurations).forEach((key) => {
            const value = temporalConfigurations[key];

            if (Number.isInteger(value)) {
                configurations[key] = value;
            }
        });
    }

    /**
     * If the fileTypeValidationRegexString is a valid regex, then set the fileTypeValidationRegex to the
     * new RegExp object created from the fileTypeValidationRegexString.
     *
     * @param root - The root element of the image uploader component.
     */
    function setRegexValidations(root) {
        let fileTypeValidationRegex = null;
        let isValidRegex = true;

        const fileTypeValidationRegexString =
            root.dataset.imageUploaderFileTypeRegex;

        try {
            fileTypeValidationRegex = new RegExp(fileTypeValidationRegexString);
        } catch (e) {
            isValidRegex = false;
        }

        if (fileTypeValidationRegex && isValidRegex) {
            configurations.fileTypeValidationRegex = fileTypeValidationRegex;
        }
    }

    /**
     * The ImageUploader function takes a query as an argument, and creates a set of
     * functions that manipulates the DOM to allow the user to upload files from their computer to the browser.
     *
     * @constructor
     * @param {string} query - The query selector for the root element of the image uploader component.
     * @returns The image uploader object is returned.
     */
    const ImageUploader = function (query) {
        const root = document.querySelector(query);

        if (!root) {
            return null;
        }

        setHtmlElements(root);
        setRegexValidations(root);
        setImageUploaderConfigurations(root);
        addEventListeners();
        return this;
    };

    /* Exposes the files selected by the user to the outside world. */
    ImageUploader.prototype.getFiles = function () {
        return imageFiles;
    };

    return ImageUploader;
});

new window.ImageUploader("[data-image-uploader]");
