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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/delete.faculty.index.js":
/*!****************************************************!*\
  !*** ./resources/js/pages/delete.faculty.index.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function makeid(length) {
  var result = '';
  var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var charactersLength = characters.length;

  for (var i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }

  return result;
}

$(document).on('click', '.sa-warning', function (event) {
  var exam_id = event.target.parentNode.dataset.exam;
  var exam_row = event.target.parentElement.parentElement.parentElement.parentElement.parentElement;
  console.log(exam_id);
  swal.queue([{
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    showLoaderOnConfirm: true,
    confirmButtonColor: "#f46a6a",
    cancelButtonColor: "#8c8c8c",
    confirmButtonText: "Yes, delete it!",
    preConfirm: function preConfirm() {
      return new Promise(function (resolve) {
        var captcha = makeid(5);
        Swal.fire({
          title: 'Verification',
          html: 'Type the characters you see  bellow <h3 class="text-primary">' + captcha + '</h3>',
          input: 'text',
          showCancelButton: true,
          confirmButtonText: 'Submit',
          showLoaderOnConfirm: true,
          confirmButtonColor: "#5b73e8",
          cancelButtonColor: "#f46a6a",
          preConfirm: function preConfirm(text) {
            return new Promise(function (resolve, reject) {
              if (text == captcha) {
                $.get('/admin/faculties/delete/' + exam_id).done(function (data) {
                  if (data.code == 200) {
                    $("#exam" + event.target.parentNode.dataset.exam).closest('tr').fadeOut(); // exam_row.style.display = 'none';

                    Swal.fire("#" + exam_id + " Deleted!", "Your " + data.msg + " has been deleted.", "success");
                    resolve();
                  } else {
                    Swal.fire("#" + exam_id + " Error!", data.msg, "error");
                    resolve();
                  }
                });
              } else {
                Swal.fire("Mismatch!", "Your captcha was mismatched .", "warning");
                reject();
              }
            });
          },
          allowOutsideClick: false
        });
      });
    }
  }])["catch"](swal.noop);
});

/***/ }),

/***/ 2:
/*!**********************************************************!*\
  !*** multi ./resources/js/pages/delete.faculty.index.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\ApplyUoJ\resources\js\pages\delete.faculty.index.js */"./resources/js/pages/delete.faculty.index.js");


/***/ })

/******/ });