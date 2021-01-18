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

jQuery(document).ready(function( $ ){
  $('.navigation').click( function () {
      $('.themes-list').toggle('slow')
  })
})

let darkMode = document.getElementById('btn-dark-mode')

if (darkMode) {
  let body = document.getElementById('body')
  darkMode.addEventListener('click', function () {
    body.classList.toggle('dark-theme')
    if (body.classList.contains('dark-theme')) {
      setCookie('theme', 'dark')
    } else {
      setCookie('theme', 'light')
    }
  })
}

let darkModeMobile = document.getElementById('btn-dark-mode-mobile')

if (darkModeMobile) {
  let body = document.getElementById('body')
  darkModeMobile.addEventListener('click', function () {
    body.classList.toggle('dark-theme')
    if (body.classList.contains('dark-theme')) {
      setCookie('theme', 'dark')
    } else {
      setCookie('theme', 'light')
    }
  })
}
// https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
function setCookie (name, value) {
  var d = new Date()
  d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000))
  var expires = 'expires=' + d.toUTCString()
  document.cookie = name + '=' + value + ';' + expires + ';path=/'
}

let back = document.getElementById('logo-back')
if (back) {
  back.addEventListener('click', function (e) {
      console.log('coucou')
    e.preventDefault()
    window.history.back()
  })
}
