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

eval("// script turn the logo\nvar logo = document.getElementById('logo');\n\nif (logo) {\n  logo.addEventListener('mouseover', function () {\n    if (logo.classList.contains('rotation-left')) {\n      logo.classList.remove('rotation-left');\n    }\n\n    logo.classList.add('rotation-right');\n  });\n  logo.addEventListener('mouseout', function () {\n    if (logo.classList.contains('rotation-right')) {\n      logo.classList.remove('rotation-right');\n    }\n\n    logo.classList.add('rotation-left');\n  });\n} // themes list button\n\n\nvar navigation = document.querySelector('.navigation');\nvar themesList = document.querySelector('.themes-list');\nnavigation.addEventListener('mouseover', function (e) {\n  themesList.classList.add('open-list');\n});\nnavigation.addEventListener('mouseout', function (e) {\n  themesList.classList.remove('open-list');\n});\nvar darkMode = document.getElementById('btn-dark-mode');\n\nif (darkMode) {\n  var body = document.getElementById('body');\n  darkMode.addEventListener('click', function () {\n    body.classList.toggle('dark-theme');\n\n    if (body.classList.contains('dark-theme')) {\n      // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website\n      setCookie('theme', 'dark');\n    } else {\n      setCookie('theme', 'light');\n    }\n  });\n}\n\nvar darkModeMobile = document.getElementById('btn-dark-mode-mobile');\n\nif (darkModeMobile) {\n  var _body = document.getElementById('body');\n\n  darkModeMobile.addEventListener('click', function () {\n    _body.classList.toggle('dark-theme');\n\n    if (_body.classList.contains('dark-theme')) {\n      // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website\n      setCookie('theme', 'dark');\n    } else {\n      setCookie('theme', 'light');\n    }\n  });\n} // https://grantjam.es/light-and-dark-theme-toggle-on-a-laravel-website\n\n\nfunction setCookie(name, value) {\n  var d = new Date();\n  d.setTime(d.getTime() + 365 * 24 * 60 * 60 * 1000);\n  var expires = 'expires=' + d.toUTCString();\n  document.cookie = name + '=' + value + ';' + expires + ';path=/';\n}\n\nvar back = document.getElementById('logo-back');\n\nif (back) {\n  back.addEventListener('click', function (e) {\n    e.preventDefault();\n    window.history.back();\n  });\n}\n\nvar back2 = document.getElementById('logo-back2');\n\nif (back2) {\n  back2.addEventListener('click', function (e) {\n    e.preventDefault();\n    window.history.back();\n  });\n} // script for long titles on the pages - reduce font size\n\n\nvar title = document.querySelector('.entry-title__page h1');\n\nif (title) {\n  var text = title.textContent;\n  var words = text.split(' ');\n\n  for (var i = 0; i < words.length; i++) {\n    if (words[i].length > 9) {\n      title.classList.add('long-text');\n    }\n  }\n} // get search form on mobile\n\n\nvar glass = document.getElementById('glass-mobile');\n\nif (glass) {\n  var searchContainer = document.getElementById('search-container-mobile');\n  var object = document.getElementsByClassName('header-mobile-object');\n  glass.addEventListener('click', function () {\n    searchContainer.classList.toggle('reveal');\n    glass.classList.toggle('reveal');\n\n    for (var _index = 0; _index < object.length; _index++) {\n      object[_index].classList.toggle('unreveal');\n    }\n  });\n} // open pdf in new tab\n\n\nvar pdf = document.getElementById('pdf');\n\nif (pdf) {\n  var href = pdf.dataset.link;\n  pdf.addEventListener('click', function (e) {\n    window.open(href);\n  });\n}\n\nvar hamburger = document.querySelector('.m-nav-toggle');\nvar op = document.querySelector('.menu');\nvar cross = document.querySelector('.close');\nvar menuItem = document.querySelectorAll('.menu-item');\nhamburger.addEventListener('click', function () {\n  op.classList.toggle('is-open');\n  cross.classList.toggle('is-open');\n});\ncross.addEventListener('click', function () {\n  op.classList.remove('is-open');\n  cross.classList.remove('is-open');\n});\n\nfor (var index = 0; index < menuItem.length; index++) {\n  menuItem[index].addEventListener('click', function () {\n    op.classList.remove('is-open');\n    cross.classList.remove('is-open');\n  });\n}//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZnJvbnQuanM/MTRhOCJdLCJuYW1lcyI6WyJsb2dvIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsImFkZEV2ZW50TGlzdGVuZXIiLCJjbGFzc0xpc3QiLCJjb250YWlucyIsInJlbW92ZSIsImFkZCIsIm5hdmlnYXRpb24iLCJxdWVyeVNlbGVjdG9yIiwidGhlbWVzTGlzdCIsImUiLCJkYXJrTW9kZSIsImJvZHkiLCJ0b2dnbGUiLCJzZXRDb29raWUiLCJkYXJrTW9kZU1vYmlsZSIsIm5hbWUiLCJ2YWx1ZSIsImQiLCJEYXRlIiwic2V0VGltZSIsImdldFRpbWUiLCJleHBpcmVzIiwidG9VVENTdHJpbmciLCJjb29raWUiLCJiYWNrIiwicHJldmVudERlZmF1bHQiLCJ3aW5kb3ciLCJoaXN0b3J5IiwiYmFjazIiLCJ0aXRsZSIsInRleHQiLCJ0ZXh0Q29udGVudCIsIndvcmRzIiwic3BsaXQiLCJpIiwibGVuZ3RoIiwiZ2xhc3MiLCJzZWFyY2hDb250YWluZXIiLCJvYmplY3QiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwiaW5kZXgiLCJwZGYiLCJocmVmIiwiZGF0YXNldCIsImxpbmsiLCJvcGVuIiwiaGFtYnVyZ2VyIiwib3AiLCJjcm9zcyIsIm1lbnVJdGVtIiwicXVlcnlTZWxlY3RvckFsbCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQSxJQUFNQSxJQUFJLEdBQUdDLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixNQUF4QixDQUFiOztBQUVBLElBQUlGLElBQUosRUFBVTtBQUNSQSxNQUFJLENBQUNHLGdCQUFMLENBQXNCLFdBQXRCLEVBQW1DLFlBQVk7QUFDN0MsUUFBSUgsSUFBSSxDQUFDSSxTQUFMLENBQWVDLFFBQWYsQ0FBd0IsZUFBeEIsQ0FBSixFQUE4QztBQUM1Q0wsVUFBSSxDQUFDSSxTQUFMLENBQWVFLE1BQWYsQ0FBc0IsZUFBdEI7QUFDRDs7QUFDRE4sUUFBSSxDQUFDSSxTQUFMLENBQWVH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MkIsT0FBM0IsRUFBb0MsWUFBWTtBQUM5QzhDLElBQUUsQ0FBQzdDLFNBQUgsQ0FBYVUsTUFBYixDQUFvQixTQUFwQjtBQUNBb0MsT0FBSyxDQUFDOUMsU0FBTixDQUFnQlUsTUFBaEIsQ0FBdUIsU0FBdkI7QUFDRCxDQUhEO0FBSUFvQyxLQUFLLENBQUMvQyxnQkFBTixDQUF1QixPQUF2QixFQUFnQyxZQUFZO0FBQzFDOEMsSUFBRSxDQUFDN0MsU0FBSCxDQUFhRSxNQUFiLENBQW9CLFNBQXBCO0FBQ0E0QyxPQUFLLENBQUM5QyxTQUFOLENBQWdCRSxNQUFoQixDQUF1QixTQUF2QjtBQUNELENBSEQ7O0FBSUEsS0FBSyxJQUFJb0MsS0FBSyxHQUFHLENBQWpCLEVBQW9CQSxLQUFLLEdBQUdTLFFBQVEsQ0FBQ2QsTUFBckMsRUFBNkNLLEtBQUssRUFBbEQsRUFBc0Q7QUFDcERTLFVBQVEsQ0FBQ1QsS0FBRCxDQUFSLENBQWdCdkMsZ0JBQWhCLENBQWlDLE9BQWpDLEVBQTBDLFlBQVk7QUFDcEQ4QyxNQUFFLENBQUM3QyxTQUFILENBQWFFLE1BQWIsQ0FBb0IsU0FBcEI7QUFDQTRDLFNBQUssQ0FBQzlDLFNBQU4sQ0FBZ0JFLE1BQWhCLENBQXVCLFNBQXZCO0FBQ0QsR0FIRDtBQUlEIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2Zyb250LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLy8gc2NyaXB0IHR1cm4gdGhlIGxvZ29cbmNvbnN0IGxvZ28gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nbycpXG5cbmlmIChsb2dvKSB7XG4gIGxvZ28uYWRkRXZlbnRMaXN0ZW5lcignbW91c2VvdmVyJywgZnVuY3Rpb24gKCkge1xuICAgIGlmIChsb2dvLmNsYXNzTGlzdC5jb250YWlucygncm90YXRpb24tbGVmdCcpKSB7XG4gICAgICBsb2dvLmNsYXNzTGlzdC5yZW1vdmUoJ3JvdGF0aW9uLWxlZnQnKVxuICAgIH1cbiAgICBsb2dvLmNsYXNzTGlzdC5hZGQoJ3JvdGF0aW9uLXJpZ2h0JylcbiAgfSlcblxuICBsb2dvLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlb3V0JywgZnVuY3Rpb24gKCkge1xuICAgIGlmIChsb2dvLmNsYXNzTGlzdC5jb250YWlucygncm90YXRpb24tcmlnaHQnKSkge1xuICAgICAgbG9nby5jbGFzc0xpc3QucmVtb3ZlKCdyb3RhdGlvbi1yaWdodCcpXG4gICAgfVxuICAgIGxvZ28uY2xhc3NMaXN0LmFkZCgncm90YXRpb24tbGVmdCcpXG4gIH0pXG59XG5cbi8vIHRoZW1lcyBsaXN0IGJ1dHRvblxubGV0IG5hdmlnYXRpb24gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubmF2aWdhdGlvbicpXG5sZXQgdGhlbWVzTGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy50aGVtZXMtbGlzdCcpXG5uYXZpZ2F0aW9uLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlb3ZlcicsIGZ1bmN0aW9uIChlKSB7XG4gIHRoZW1lc0xpc3QuY2xhc3NMaXN0LmFkZCgnb3Blbi1saXN0Jylcbn0pXG5uYXZpZ2F0aW9uLmFkZEV2ZW50TGlzdGVuZXIoJ21vdXNlb3V0JywgZnVuY3Rpb24gKGUpIHtcbiAgdGhlbWVzTGlzdC5jbGFzc0xpc3QucmVtb3ZlKCdvcGVuLWxpc3QnKVxufSlcblxubGV0IGRhcmtNb2RlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2J0bi1kYXJrLW1vZGUnKVxuXG5pZiAoZGFya01vZGUpIHtcbiAgbGV0IGJvZHkgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYm9keScpXG4gIGRhcmtNb2RlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgIGJvZHkuY2xhc3NMaXN0LnRvZ2dsZSgnZGFyay10aGVtZScpXG4gICAgaWYgKGJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKCdkYXJrLXRoZW1lJykpIHtcbiAgICAvLyBodHRwczovL2dyYW50amFtLmVzL2xpZ2h0LWFuZC1kYXJrLXRoZW1lLXRvZ2dsZS1vbi1hLWxhcmF2ZWwtd2Vic2l0ZVxuICAgICAgc2V0Q29va2llKCd0aGVtZScsICdkYXJrJylcbiAgICB9IGVsc2Uge1xuICAgICAgc2V0Q29va2llKCd0aGVtZScsICdsaWdodCcpXG4gICAgfVxuICB9KVxufVxuXG5sZXQgZGFya01vZGVNb2JpbGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYnRuLWRhcmstbW9kZS1tb2JpbGUnKVxuXG5pZiAoZGFya01vZGVNb2JpbGUpIHtcbiAgbGV0IGJvZHkgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYm9keScpXG4gIGRhcmtNb2RlTW9iaWxlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgIGJvZHkuY2xhc3NMaXN0LnRvZ2dsZSgnZGFyay10aGVtZScpXG4gICAgaWYgKGJvZHkuY2xhc3NMaXN0LmNvbnRhaW5zKCdkYXJrLXRoZW1lJykpIHtcbiAgICAvLyBodHRwczovL2dyYW50amFtLmVzL2xpZ2h0LWFuZC1kYXJrLXRoZW1lLXRvZ2dsZS1vbi1hLWxhcmF2ZWwtd2Vic2l0ZVxuICAgICAgc2V0Q29va2llKCd0aGVtZScsICdkYXJrJylcbiAgICB9IGVsc2Uge1xuICAgICAgc2V0Q29va2llKCd0aGVtZScsICdsaWdodCcpXG4gICAgfVxuICB9KVxufVxuLy8gaHR0cHM6Ly9ncmFudGphbS5lcy9saWdodC1hbmQtZGFyay10aGVtZS10b2dnbGUtb24tYS1sYXJhdmVsLXdlYnNpdGVcbmZ1bmN0aW9uIHNldENvb2tpZSAobmFtZSwgdmFsdWUpIHtcbiAgdmFyIGQgPSBuZXcgRGF0ZSgpXG4gIGQuc2V0VGltZShkLmdldFRpbWUoKSArICgzNjUgKiAyNCAqIDYwICogNjAgKiAxMDAwKSlcbiAgdmFyIGV4cGlyZXMgPSAnZXhwaXJlcz0nICsgZC50b1VUQ1N0cmluZygpXG4gIGRvY3VtZW50LmNvb2tpZSA9IG5hbWUgKyAnPScgKyB2YWx1ZSArICc7JyArIGV4cGlyZXMgKyAnO3BhdGg9Lydcbn1cblxubGV0IGJhY2sgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nby1iYWNrJylcbmlmIChiYWNrKSB7XG4gIGJhY2suYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgIHdpbmRvdy5oaXN0b3J5LmJhY2soKVxuICB9KVxufVxuXG5sZXQgYmFjazIgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nby1iYWNrMicpXG5pZiAoYmFjazIpIHtcbiAgYmFjazIuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgIHdpbmRvdy5oaXN0b3J5LmJhY2soKVxuICB9KVxufVxuXG4vLyBzY3JpcHQgZm9yIGxvbmcgdGl0bGVzIG9uIHRoZSBwYWdlcyAtIHJlZHVjZSBmb250IHNpemVcbmxldCB0aXRsZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5lbnRyeS10aXRsZV9fcGFnZSBoMScpXG5cbmlmICh0aXRsZSkge1xuICBsZXQgdGV4dCA9IHRpdGxlLnRleHRDb250ZW50XG4gIHZhciB3b3JkcyA9IHRleHQuc3BsaXQoJyAnKVxuICBmb3IgKHZhciBpID0gMDsgaSA8IHdvcmRzLmxlbmd0aDsgaSsrKSB7XG4gICAgaWYgKHdvcmRzW2ldLmxlbmd0aCA+IDkpIHtcbiAgICAgIHRpdGxlLmNsYXNzTGlzdC5hZGQoJ2xvbmctdGV4dCcpXG4gICAgfVxuICB9XG59XG5cbi8vIGdldCBzZWFyY2ggZm9ybSBvbiBtb2JpbGVcbmxldCBnbGFzcyA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnbGFzcy1tb2JpbGUnKVxuXG5pZiAoZ2xhc3MpIHtcbiAgbGV0IHNlYXJjaENvbnRhaW5lciA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzZWFyY2gtY29udGFpbmVyLW1vYmlsZScpXG4gIGxldCBvYmplY3QgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKCdoZWFkZXItbW9iaWxlLW9iamVjdCcpXG4gIGdsYXNzLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgIHNlYXJjaENvbnRhaW5lci5jbGFzc0xpc3QudG9nZ2xlKCdyZXZlYWwnKVxuICAgIGdsYXNzLmNsYXNzTGlzdC50b2dnbGUoJ3JldmVhbCcpXG4gICAgZm9yIChsZXQgaW5kZXggPSAwOyBpbmRleCA8IG9iamVjdC5sZW5ndGg7IGluZGV4KyspIHtcbiAgICAgIG9iamVjdFtpbmRleF0uY2xhc3NMaXN0LnRvZ2dsZSgndW5yZXZlYWwnKVxuICAgIH1cbiAgfSlcbn1cblxuLy8gb3BlbiBwZGYgaW4gbmV3IHRhYlxubGV0IHBkZiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwZGYnKVxuXG5pZiAocGRmKSB7XG4gIGxldCBocmVmID0gcGRmLmRhdGFzZXQubGlua1xuICBwZGYuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgIHdpbmRvdy5vcGVuKGhyZWYpXG4gIH0pXG59XG5cbnZhciBoYW1idXJnZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubS1uYXYtdG9nZ2xlJylcbnZhciBvcCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5tZW51JylcbnZhciBjcm9zcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jbG9zZScpXG52YXIgbWVudUl0ZW0gPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcubWVudS1pdGVtJylcbmhhbWJ1cmdlci5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgb3AuY2xhc3NMaXN0LnRvZ2dsZSgnaXMtb3BlbicpXG4gIGNyb3NzLmNsYXNzTGlzdC50b2dnbGUoJ2lzLW9wZW4nKVxufSlcbmNyb3NzLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICBvcC5jbGFzc0xpc3QucmVtb3ZlKCdpcy1vcGVuJylcbiAgY3Jvc3MuY2xhc3NMaXN0LnJlbW92ZSgnaXMtb3BlbicpXG59KVxuZm9yICh2YXIgaW5kZXggPSAwOyBpbmRleCA8IG1lbnVJdGVtLmxlbmd0aDsgaW5kZXgrKykge1xuICBtZW51SXRlbVtpbmRleF0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgb3AuY2xhc3NMaXN0LnJlbW92ZSgnaXMtb3BlbicpXG4gICAgY3Jvc3MuY2xhc3NMaXN0LnJlbW92ZSgnaXMtb3BlbicpXG4gIH0pXG59XG5cbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/front.js\n");

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/front.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\cyril.bron\Documents\dev-web\terreCommune\web-doc-dev\app\web-doc\resources\js\front.js */"./resources/js/front.js");


/***/ })

/******/ });