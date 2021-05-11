/* preview image before uploading with fileReader Object */
const inpFile = document.getElementById('image')
const previewContainer = document.getElementById('imagePreview')
if (previewContainer != null) {
  const previewImage = previewContainer.querySelector('.image-preview__image')
  const previewDefaultText = previewContainer.querySelector('.image-preview__default-text')

  inpFile.addEventListener('change', function () {
    const file = this.files[0]
    if (file) {
      const reader = new FileReader()
      previewDefaultText.style.display = 'none'
      previewImage.style.display = 'block'

      reader.addEventListener('load', function () {
        previewImage.setAttribute('src', this.result)
      })
      reader.readAsDataURL(file)
    } else {
    /* refresh upload system when someone come back without choosing a file */
      previewDefaultText.style.display = null
      previewImage.style.display = null
      previewImage.setAttribute('src', '')
    }
  })
}

/* change image */
const containerEditImage = document.querySelector('.edit-image')
if (containerEditImage != null) {
  const editImage = containerEditImage.querySelector('.edit-image__middle')
  const upload = document.querySelector('.upload')

  editImage.addEventListener('click', function () {
    containerEditImage.style.display = 'none'
    upload.style.display = 'block'
  })
}

/* change pdf */
const containerEditPdf = document.querySelector('.edit-pdf')

if (containerEditPdf) {
  const editPdf = containerEditPdf.querySelector('.edit-pdf__button')
  const uploadPdf = document.querySelector('.upload-pdf')

  editPdf.addEventListener('click', function (e) {
    e.preventDefault()
    containerEditPdf.style.display = 'none'
    uploadPdf.style.display = 'block'
  })
}

// count characters for excerpt textarea
$('#excerpt').keyup(function () {
  let characterCount = $(this).val().length
  let current = $('#current')
  current.text(characterCount)
});
