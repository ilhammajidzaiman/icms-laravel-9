function previewImg() {
    const cover = document.querySelector('#file');
    const imgPreview = document.querySelector('.img-preview');
    const fileCover = new FileReader();
    fileCover.readAsDataURL(cover.files[0]);
    fileCover.onload = function(e) {
        imgPreview.src = e.target.result;
    }
}

function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    const oFReader = new FileReader();
    imgPreview.style.display = 'block';
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
