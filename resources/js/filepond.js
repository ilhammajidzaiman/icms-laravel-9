import * as FilePond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

const inputElement = document.querySelector("#file");
const attachmentInputElement = document.querySelector("#attachment");
const fileRecord = inputElement?.dataset.fileRecord;
const attachmentRecord = attachmentInputElement?.dataset.attachmentRecord
    ? JSON.parse(attachmentInputElement.dataset.attachmentRecord)
    : [];

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

FilePond.registerPlugin(FilePondPluginImagePreview);

FilePond.create(inputElement).setOptions({
    server: {
        process: "/admin/filepond/upload",
        revert: null,
        fetch: null,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    },
    files: fileRecord,
    maxFileSize: "10MB",
});

FilePond.create(attachmentInputElement).setOptions({
    server: {
        process: "/admin/filepond/upload",
        fetch: null,
        revert: null,
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
    },
    files: attachmentRecord,
    maxFileSize: "10MB",
});
