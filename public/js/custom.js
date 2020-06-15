/* preview image before uploading with fileReader Object */
const inpFile = document.getElementById('image')
const previewContainer = document.getElementById('imagePreview')
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

/* change image */
const containerEditImage = document.querySelector('.edit-image')
const editImage = containerEditImage.querySelector('.edit-image__middle')
const upload = document.querySelector('.upload')

editImage.addEventListener('click', function () {
  containerEditImage.style.opacity = '0'
  containerEditImage.style.height = '0'
  upload.style.opacity = '1'
  upload.style.height = '200px'
})
