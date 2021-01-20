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

// script: get the themes list
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
    // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
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
    // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
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
    e.preventDefault()
    window.history.back()
  })
}

// script for long titles on the pages - reduce font size
let title = document.querySelector('.entry-title__page h1')

if (title) {
  let text = title.textContent
  var words = text.split(' ')
  for (var i = 0; i < words.length; i++) {
    if (words[i].length > 9) {
      title.classList.add('long-text')
    }
  }
}

// get search form on mobile
let glass = document.getElementById('glass-mobile')

if (glass) {
  let searchContainer = document.getElementById('search-container-mobile')
  let object = document.getElementsByClassName('header-mobile-object')
  glass.addEventListener('click', function () {
    searchContainer.classList.toggle('reveal')
    glass.classList.toggle('reveal')
    for (let index = 0; index < object.length; index++) {
      object[index].classList.toggle('unreveal')
    }
  })
}
