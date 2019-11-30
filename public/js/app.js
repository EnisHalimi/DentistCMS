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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

function filterUserFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("search-user");
  filter = input.value.toUpperCase();
  div = document.getElementById("dropdown-user");
  a = div.getElementsByTagName("a");

  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;

    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function filterPacientFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("search-pacient");
  filter = input.value.toUpperCase();
  div = document.getElementById("dropdown-pacient");
  a = div.getElementsByTagName("a");

  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;

    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function DataTables() {
  $('#PacientdataTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/pacientDatatable",
    "columns": [{
      "data": "first_name"
    }, {
      "data": "last_name"
    }, {
      "data": "personal_number"
    }, {
      "data": "date_of_birth"
    }, {
      "data": "address"
    }, {
      "data": "residence"
    }, {
      "data": "Menaxhimi",
      "bSearchable": false
    }]
  });
  $('#UserdataTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/userDatatable",
    "columns": [{
      "data": "name"
    }, {
      "data": "email"
    }, {
      "data": "password"
    }, {
      "data": "position"
    }, {
      "data": "Menaxhimi",
      "bSearchable": false
    }]
  });
  $('#AppointmentdataTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/appointmentDatatable",
    "columns": [{
      "data": "pacient_id"
    }, {
      "data": "user_id"
    }, {
      "data": "date_of_appointment"
    }, {
      "data": "time_of_appointment"
    }, {
      "data": "Menaxhimi",
      "bSearchable": false
    }]
  });
  $('#VisitdataTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/visitDatatable",
    "columns": [{
      "data": "pacient_id"
    }, {
      "data": "user_id"
    }, {
      "data": "date_of_visit"
    }, {
      "data": "time_of_visit"
    }, {
      "data": "Menaxhimi",
      "bSearchable": false
    }]
  });
  $('#TreatmentdataTable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/treatmentDatatable",
    "columns": [{
      "data": "visit_id"
    }, {
      "data": "type_of_treatment"
    }, {
      "data": "duration"
    }, {
      "data": "Menaxhimi",
      "bSearchable": false
    }]
  });
}

DataTables();

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/enishalimi/Websites/Metropolis/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /home/enishalimi/Websites/Metropolis/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });