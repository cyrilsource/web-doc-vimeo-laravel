/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front.js":
/*!*******************************!*\
  !*** ./resources/js/front.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// script turn the logo
var logo = document.getElementById('logo');

if (logo) {
  logo.addEventListener('mouseover', function () {
    if (logo.classList.contains('rotation-left')) {
      logo.classList.remove('rotation-left');
    }

    logo.classList.add('rotation-right');
  });
  logo.addEventListener('mouseout', function () {
    if (logo.classList.contains('rotation-right')) {
      logo.classList.remove('rotation-right');
    }

    logo.classList.add('rotation-left');
  });
} // script: get the themes list


jQuery(document).ready(function ($) {
  $('.navigation').click(function () {
    $('.themes-list').toggle('slow');
  });
});
var darkMode = document.getElementById('btn-dark-mode');

if (darkMode) {
  var body = document.getElementById('body');
  darkMode.addEventListener('click', function () {
    body.classList.toggle('dark-theme');

    if (body.classList.contains('dark-theme')) {
      // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
      setCookie('theme', 'dark');
    } else {
      setCookie('theme', 'light');
    }
  });
}

var darkModeMobile = document.getElementById('btn-dark-mode-mobile');

if (darkModeMobile) {
  var _body = document.getElementById('body');

  darkModeMobile.addEventListener('click', function () {
    _body.classList.toggle('dark-theme');

    if (_body.classList.contains('dark-theme')) {
      // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website
      setCookie('theme', 'dark');
    } else {
      setCookie('theme', 'light');
    }
  });
} // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website


function setCookie(name, value) {
  var d = new Date();
  d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);
  var expires = 'expires=' + d.toUTCString();
  document.cookie = name + '=' + value + ';' + expires + ';path=/';
}

var back = document.getElementById('logo-back');

if (back) {
  back.addEventListener('click', function (e) {
    e.preventDefault();
    window.history.back();
  });
}

var back2 = document.getElementById('logo-back2');

if (back2) {
  back2.addEventListener('click', function (e) {
    e.preventDefault();
    window.history.back();
  });
} // script for long titles on the pages - reduce font size


var title = document.querySelector('.entry-title__page h1');

if (title) {
  var text = title.textContent;
  var words = text.split(' ');

  for (var i = 0; i < words.length; i++) {
    if (words[i].length > 9) {
      title.classList.add('long-text');
    }
  }
} // get search form on mobile


var glass = document.getElementById('glass-mobile');

if (glass) {
  var searchContainer = document.getElementById('search-container-mobile');
  var object = document.getElementsByClassName('header-mobile-object');
  glass.addEventListener('click', function () {
    searchContainer.classList.toggle('reveal');
    glass.classList.toggle('reveal');

    for (var index = 0; index < object.length; index++) {
      object[index].classList.toggle('unreveal');
    }
  });
} // open pdf in new tab


var pdf = document.getElementById('pdf');
var href = pdf.dataset.link;

if (pdf) {
  pdf.addEventListener('click', function (e) {
    window.open(href);
  });
}

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/front.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/terrecommune/resources/js/front.js */"./resources/js/front.js");


/***/ })

/******/ });