// script turn the logo
const logo = document.getElementById('logo')

if (logo) {
  logo.addEventListener('mouseover', function () {
    if (logo.classList.contains('rotation-left')) {
      logo.classList.remove('rotation-left')
  }
    logo.classList.add('rotation-right')
  })

  logo.addEventListener('mouseout', function () {
    if (logo.classList.contains('rotation-right')) {
      logo.classList.remove('rotation-right')
    }
    logo.classList.add('rotation-left')
  })
}

jQuery( document ).ready(function( $ ){
    $('.navigation').click(function() {
      $('.themes-list').toggle('slow');
    });
  });