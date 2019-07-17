(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/js/Components/Auth/Auth.js":
/*!*******************************************!*\
  !*** ./assets/js/Components/Auth/Auth.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var Auth = {
  isAuthenticated: localStorage.getItem('token') ? true : false,
  // TODO: Check for token every minute
  authenticate: function authenticate(callback) {
    //Ajax
    this.isAuthenticated = true;
  },
  signOut: function signOut(callback) {
    this.isAuthenticated = false;
    localStorage.removeItem('token');
  }
};
/* harmony default export */ __webpack_exports__["default"] = (Auth);

/***/ }),

/***/ "./assets/js/Components/Auth/AuthButton.js":
/*!*************************************************!*\
  !*** ./assets/js/Components/Auth/AuthButton.js ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/esm/react-router-dom.js");
/* harmony import */ var _Auth__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Auth */ "./assets/js/Components/Auth/Auth.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var mdbreact__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! mdbreact */ "./node_modules/mdbreact/dist/mdbreact.esm.js");




var AuthButton = Object(react_router_dom__WEBPACK_IMPORTED_MODULE_0__["withRouter"])(function (_ref) {
  var history = _ref.history;
  return _Auth__WEBPACK_IMPORTED_MODULE_1__["default"].isAuthenticated ? react__WEBPACK_IMPORTED_MODULE_2___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_3__["NavLink"], {
    to: "/login",
    onClick: function onClick() {
      _Auth__WEBPACK_IMPORTED_MODULE_1__["default"].signOut();
    }
  }, "Sign out") : react__WEBPACK_IMPORTED_MODULE_2___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_3__["NavLink"], {
    to: "/login"
  }, "Login");
});
/* harmony default export */ __webpack_exports__["default"] = (AuthButton);

/***/ }),

/***/ "./assets/js/Components/Auth/PrivateRoute.js":
/*!***************************************************!*\
  !*** ./assets/js/Components/Auth/PrivateRoute.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_index_of__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.index-of */ "./node_modules/core-js/modules/es.array.index-of.js");
/* harmony import */ var core_js_modules_es_array_index_of__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_index_of__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_object_assign__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.object.assign */ "./node_modules/core-js/modules/es.object.assign.js");
/* harmony import */ var core_js_modules_es_object_assign__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_assign__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_object_keys__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.object.keys */ "./node_modules/core-js/modules/es.object.keys.js");
/* harmony import */ var core_js_modules_es_object_keys__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_keys__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/esm/react-router-dom.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _Auth__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./Auth */ "./assets/js/Components/Auth/Auth.js");





function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _objectWithoutProperties(source, excluded) { if (source == null) return {}; var target = _objectWithoutPropertiesLoose(source, excluded); var key, i; if (Object.getOwnPropertySymbols) { var sourceSymbolKeys = Object.getOwnPropertySymbols(source); for (i = 0; i < sourceSymbolKeys.length; i++) { key = sourceSymbolKeys[i]; if (excluded.indexOf(key) >= 0) continue; if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue; target[key] = source[key]; } } return target; }

function _objectWithoutPropertiesLoose(source, excluded) { if (source == null) return {}; var target = {}; var sourceKeys = Object.keys(source); var key, i; for (i = 0; i < sourceKeys.length; i++) { key = sourceKeys[i]; if (excluded.indexOf(key) >= 0) continue; target[key] = source[key]; } return target; }





function PrivateRoute(_ref) {
  var Component = _ref.component,
      rest = _objectWithoutProperties(_ref, ["component"]);

  return react__WEBPACK_IMPORTED_MODULE_5___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_4__["Route"], _extends({}, rest, {
    render: function render(props) {
      return _Auth__WEBPACK_IMPORTED_MODULE_6__["default"].isAuthenticated === true || localStorage.getItem('token') ? react__WEBPACK_IMPORTED_MODULE_5___default.a.createElement(Component, props) : react__WEBPACK_IMPORTED_MODULE_5___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_4__["Redirect"], {
        to: {
          pathname: "/restricted",
          state: {
            from: props.location
          }
        }
      });
    }
  }));
}

;
/* harmony default export */ __webpack_exports__["default"] = (PrivateRoute);

/***/ }),

/***/ "./assets/js/Components/Navbar.js":
/*!****************************************!*\
  !*** ./assets/js/Components/Navbar.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.function.bind */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.create */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.define-property */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var mdbreact__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! mdbreact */ "./node_modules/mdbreact/dist/mdbreact.esm.js");
/* harmony import */ var _Auth_AuthButton__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./Auth/AuthButton */ "./assets/js/Components/Auth/AuthButton.js");













function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }





var NavBar =
/*#__PURE__*/
function (_Component) {
  _inherits(NavBar, _Component);

  function NavBar(props) {
    var _this;

    _classCallCheck(this, NavBar);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(NavBar).call(this, props));
    _this.state = {
      collapse: false,
      isWideEnough: false
    };
    _this.onClick = _this.onClick.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(NavBar, [{
    key: "onClick",
    value: function onClick() {
      this.setState({
        collapse: !this.state.collapse
      });
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      var links = document.getElementsByClassName('nav-link');
      var _iteratorNormalCompletion = true;
      var _didIteratorError = false;
      var _iteratorError = undefined;

      try {
        var _loop = function _loop() {
          var link = _step.value;

          link.onclick = function () {
            var _iteratorNormalCompletion2 = true;
            var _didIteratorError2 = false;
            var _iteratorError2 = undefined;

            try {
              for (var _iterator2 = links[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
                var elem = _step2.value;
                elem.parentElement.classList.remove('active');
              }
            } catch (err) {
              _didIteratorError2 = true;
              _iteratorError2 = err;
            } finally {
              try {
                if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
                  _iterator2["return"]();
                }
              } finally {
                if (_didIteratorError2) {
                  throw _iteratorError2;
                }
              }
            }

            link.parentElement.classList.add('active');
          };
        };

        for (var _iterator = links[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
          _loop();
        }
      } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
      } finally {
        try {
          if (!_iteratorNormalCompletion && _iterator["return"] != null) {
            _iterator["return"]();
          }
        } finally {
          if (_didIteratorError) {
            throw _iteratorError;
          }
        }
      }
    }
  }, {
    key: "render",
    value: function render() {
      return react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["Navbar"], {
        color: "white",
        light: true,
        expand: "md",
        scrolling: true
      }, !this.state.isWideEnough && react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavbarToggler"], {
        onClick: this.onClick
      }), react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["Collapse"], {
        isOpen: this.state.collapse,
        navbar: true
      }, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavbarNav"], {
        left: true
      }, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavItem"], null, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavLink"], {
        to: "/"
      }, "Task-Manager")), react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavItem"], null, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavLink"], {
        to: "/users"
      }, "Users")), react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavItem"], null, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavLink"], {
        to: "/tasks",
        token: this.state.token
      }, "Tasks")), react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_13__["NavItem"], null, react__WEBPACK_IMPORTED_MODULE_12___default.a.createElement(_Auth_AuthButton__WEBPACK_IMPORTED_MODULE_14__["default"], null)))));
    }
  }]);

  return NavBar;
}(react__WEBPACK_IMPORTED_MODULE_12__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (NavBar);

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.create */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.define-property */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.promise */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _fortawesome_fontawesome_free_css_all_min_css__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! @fortawesome/fontawesome-free/css/all.min.css */ "./node_modules/@fortawesome/fontawesome-free/css/all.min.css");
/* harmony import */ var _fortawesome_fontawesome_free_css_all_min_css__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(_fortawesome_fontawesome_free_css_all_min_css__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var bootstrap_css_only_css_bootstrap_min_css__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! bootstrap-css-only/css/bootstrap.min.css */ "./node_modules/bootstrap-css-only/css/bootstrap.min.css");
/* harmony import */ var bootstrap_css_only_css_bootstrap_min_css__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(bootstrap_css_only_css_bootstrap_min_css__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var mdbreact_dist_css_mdb_css__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! mdbreact/dist/css/mdb.css */ "./node_modules/mdbreact/dist/css/mdb.css");
/* harmony import */ var mdbreact_dist_css_mdb_css__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(mdbreact_dist_css_mdb_css__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(react_dom__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/esm/react-router-dom.js");
/* harmony import */ var _Components_Navbar__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./Components/Navbar */ "./assets/js/Components/Navbar.js");
/* harmony import */ var _Components_Auth_PrivateRoute__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./Components/Auth/PrivateRoute */ "./assets/js/Components/Auth/PrivateRoute.js");
/* harmony import */ var _pages_Home__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ./pages/Home */ "./assets/js/pages/Home.js");
/* harmony import */ var _pages_tasks_TasksIndex__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./pages/tasks/TasksIndex */ "./assets/js/pages/tasks/TasksIndex.js");
/* harmony import */ var _pages_users_UsersIndex__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./pages/users/UsersIndex */ "./assets/js/pages/users/UsersIndex.js");
/* harmony import */ var _pages_login_Login__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./pages/login/Login */ "./assets/js/pages/login/Login.js");
/* harmony import */ var _pages_restricted_RestrictedPage__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./pages/restricted/RestrictedPage */ "./assets/js/pages/restricted/RestrictedPage.js");













function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

__webpack_require__.e(/*! import() */ 0).then(__webpack_require__.t.bind(null, /*! ../css/app.scss */ "./assets/css/app.scss", 7));














var App =
/*#__PURE__*/
function (_React$Component) {
  _inherits(App, _React$Component);

  function App(props) {
    _classCallCheck(this, App);

    return _possibleConstructorReturn(this, _getPrototypeOf(App).call(this, props));
  }

  _createClass(App, [{
    key: "render",
    value: function render() {
      return react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_17__["BrowserRouter"], null, react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(_Components_Navbar__WEBPACK_IMPORTED_MODULE_18__["default"], null), react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_17__["Switch"], null, react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(_Components_Auth_PrivateRoute__WEBPACK_IMPORTED_MODULE_19__["default"], {
        path: "/",
        component: _pages_Home__WEBPACK_IMPORTED_MODULE_20__["default"],
        exact: true
      }), react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(_Components_Auth_PrivateRoute__WEBPACK_IMPORTED_MODULE_19__["default"], {
        path: "/users",
        component: _pages_users_UsersIndex__WEBPACK_IMPORTED_MODULE_22__["default"]
      }), react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(_Components_Auth_PrivateRoute__WEBPACK_IMPORTED_MODULE_19__["default"], {
        path: "/tasks",
        component: _pages_tasks_TasksIndex__WEBPACK_IMPORTED_MODULE_21__["default"]
      }), react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_17__["Route"], {
        path: "/login",
        component: _pages_login_Login__WEBPACK_IMPORTED_MODULE_23__["default"]
      }), react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(react_router_dom__WEBPACK_IMPORTED_MODULE_17__["Route"], {
        path: "/restricted",
        component: _pages_restricted_RestrictedPage__WEBPACK_IMPORTED_MODULE_24__["default"]
      })));
    }
  }]);

  return App;
}(react__WEBPACK_IMPORTED_MODULE_15___default.a.Component);

Object(react_dom__WEBPACK_IMPORTED_MODULE_16__["render"])(react__WEBPACK_IMPORTED_MODULE_15___default.a.createElement(App, null), document.getElementById('root'));

/***/ }),

/***/ "./assets/js/pages/Home.js":
/*!*********************************!*\
  !*** ./assets/js/pages/Home.js ***!
  \*********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);


var Home = function Home() {
  return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("div", {
    className: "container"
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("h1", {
    className: "my-3"
  }, "Home page"), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", null, "Welcome to task manager"));
};

/* harmony default export */ __webpack_exports__["default"] = (Home);

/***/ }),

/***/ "./assets/js/pages/login/Login.js":
/*!****************************************!*\
  !*** ./assets/js/pages/login/Login.js ***!
  \****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.function.bind */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.function.name */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_name__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.create */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.define-property */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.promise */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var mdbreact__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! mdbreact */ "./node_modules/mdbreact/dist/mdbreact.esm.js");
/* harmony import */ var _Components_Auth_Auth__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ../../Components/Auth/Auth */ "./assets/js/Components/Auth/Auth.js");















function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }





var Login =
/*#__PURE__*/
function (_Component) {
  _inherits(Login, _Component);

  function Login(props) {
    var _this;

    _classCallCheck(this, Login);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(Login).call(this, props));
    _this.state = {
      isShowingError: false,
      username: '',
      password: '',
      redirectToReferer: false
    };
    _this.handleInputChange = _this.handleInputChange.bind(_assertThisInitialized(_this));
    _this.handleFormSubmit = _this.handleFormSubmit.bind(_assertThisInitialized(_this));
    _this.handleKeyPress = _this.handleKeyPress.bind(_assertThisInitialized(_this));
    return _this;
  }

  _createClass(Login, [{
    key: "handleFormSubmit",
    value: function handleFormSubmit(e) {
      var _this2 = this;

      e.preventDefault();
      var loginForm = e.target;
      fetch(loginForm.getAttribute('action'), {
        method: 'post',
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          username: this.state.username,
          password: this.state.password
        })
      }).then(function (response) {
        return response.json();
      }).then(function (response) {
        // If there is an authorisation error
        if (response.code === 401) {
          // Show error
          _this2.setState({
            isShowingError: true
          });

          var loginErrorContainer = document.getElementById('loginErrorContainer');
          loginErrorContainer.innerText = response.message;
          return;
        } // Save token to localStorage


        if (typeof Storage !== "undefined") {
          localStorage.setItem("token", response.token);
        } // Authorise


        _Components_Auth_Auth__WEBPACK_IMPORTED_MODULE_16__["default"].authenticate(function () {
          _this2.setState(function () {
            return {
              redirectToReferer: true
            };
          });
        }); // Redirect to homepage

        _this2.props.history.push("/");
      });
    }
  }, {
    key: "handleInputChange",
    value: function handleInputChange(e) {
      this.setState(_defineProperty({}, e.target.name, e.target.value));
    }
  }, {
    key: "handleKeyPress",
    value: function handleKeyPress(e) {
      if (e.keyCode === 13) return this.handleFormSubmit;
    }
  }, {
    key: "render",
    value: function render() {
      var errorContainer;

      if (this.state.isShowingError) {
        errorContainer = react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("div", {
          className: "alert alert-danger",
          id: "loginErrorContainer"
        });
      }

      return react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_15__["MDBContainer"], null, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_15__["MDBRow"], {
        center: true
      }, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_15__["MDBCol"], {
        md: "6"
      }, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("form", {
        method: "post",
        action: "/login_check",
        className: "login__form",
        onSubmit: this.handleFormSubmit
      }, errorContainer, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("h1", {
        className: "h3 my-3 font-weight-normal"
      }, "Please sign in"), react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("div", {
        className: "form-group"
      }, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("label", {
        htmlFor: "inputUsername",
        className: "sr-only"
      }, "Username"), react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("input", {
        type: "text",
        name: "username",
        id: "inputUsername",
        className: "form-control",
        placeholder: "Username",
        autoFocus: true,
        onChange: this.handleInputChange,
        onKeyDown: this.handleKeyPress,
        required: true
      })), react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("div", {
        className: "form-group"
      }, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("label", {
        htmlFor: "inputPassword",
        className: "sr-only"
      }, "Password"), react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("input", {
        type: "password",
        name: "password",
        id: "inputPassword",
        className: "form-control",
        placeholder: "Password",
        onChange: this.handleInputChange,
        onKeyDown: this.handleKeyPress,
        required: true
      })), react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("div", {
        className: "form-group"
      }, react__WEBPACK_IMPORTED_MODULE_14___default.a.createElement("button", {
        className: "btn btn-lg btn-primary",
        type: "submit"
      }, "Sign in"))))));
    }
  }]);

  return Login;
}(react__WEBPACK_IMPORTED_MODULE_14__["Component"]);

/* harmony default export */ __webpack_exports__["default"] = (Login);

/***/ }),

/***/ "./assets/js/pages/restricted/RestrictedPage.js":
/*!******************************************************!*\
  !*** ./assets/js/pages/restricted/RestrictedPage.js ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router-dom/esm/react-router-dom.js");
/* harmony import */ var mdbreact__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! mdbreact */ "./node_modules/mdbreact/dist/mdbreact.esm.js");



var RestrictedPage = Object(react_router_dom__WEBPACK_IMPORTED_MODULE_1__["withRouter"])(function (_ref) {
  var history = _ref.history;
  return react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_2__["MDBContainer"], null, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_2__["MDBRow"], {
    center: true
  }, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_2__["MDBCol"], null, react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement("p", {
    className: "my-3"
  }, "You must log in to view the page"), react__WEBPACK_IMPORTED_MODULE_0___default.a.createElement(mdbreact__WEBPACK_IMPORTED_MODULE_2__["MDBBtn"], {
    color: "primary",
    onClick: function onClick() {
      return history.push("/login");
    }
  }, "Log in"))));
});
/* harmony default export */ __webpack_exports__["default"] = (RestrictedPage);

/***/ }),

/***/ "./assets/js/pages/tasks/TasksIndex.js":
/*!*********************************************!*\
  !*** ./assets/js/pages/tasks/TasksIndex.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return TasksIndex; });
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.array.map */ "./node_modules/core-js/modules/es.array.map.js");
/* harmony import */ var core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_map__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.create */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.define-property */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.promise */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_promise__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ../../utils */ "./assets/js/utils.js");














function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }




var TasksIndex =
/*#__PURE__*/
function (_Component) {
  _inherits(TasksIndex, _Component);

  function TasksIndex(props) {
    var _this;

    _classCallCheck(this, TasksIndex);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(TasksIndex).call(this, props));
    _this.state = {
      todo: [],
      pending: [],
      done: []
    };
    return _this;
  }

  _createClass(TasksIndex, [{
    key: "loadTasks",
    value: function loadTasks(status) {
      var _this2 = this;

      var loaders = document.querySelectorAll('.loader');
      var token = localStorage.getItem('token');
      fetch("/api/tasks?status=".concat(status), {
        headers: {
          'Authorization': "Bearer ".concat(token)
        }
      }).then(function (response) {
        return response.json();
      }).then(function (response) {
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = loaders[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var loader = _step.value;
            loader.classList.add('d-none');
          }
        } catch (err) {
          _didIteratorError = true;
          _iteratorError = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion && _iterator["return"] != null) {
              _iterator["return"]();
            }
          } finally {
            if (_didIteratorError) {
              throw _iteratorError;
            }
          }
        }

        var tasks = response.tasks.map(function (task) {
          return react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
            key: task.id,
            className: "col-sm-12 mb-3"
          }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
            className: "card text-center"
          }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
            className: "task__main_header"
          }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, "Created: ", react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("span", {
            className: "task__date"
          }, " ", Object(_utils__WEBPACK_IMPORTED_MODULE_14__["dateToString"])(task.created_at))), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, task.updated_at === null ? "Not updated" : "Updated: <span className=\"task__date\"> {dateToString(task.updated_at)}</span>")), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
            className: "task__secondary_header"
          }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("button", {
            className: "task__text_button deleteTaskButton",
            "data-task-status": "{task.status}",
            "data-task-id": "{task.id}"
          }, "Delete"), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, task.user === null && task.status === 'Todo' ? react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("button", {
            "data-task-id": task.id,
            className: "assignTaskButton"
          }, "Assign to me") : task.user), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, "Priority: ", task.priority)), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
            className: "card-body"
          }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("h5", {
            className: "card-title"
          }, task.title), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, "Status: ", react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("span", {
            className: "font-weight-bold"
          }, task.status)), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("p", {
            className: "card-text"
          }, task.description), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("button", {
            "data-task-status": "${task.status}",
            "data-task-id": "${task.id}",
            className: "btn btn-primary changeStatusButton"
          }, task.status === "Todo" ? "Move to Pending" : task.status === "Pending" ? "Move to Done" : "Need work"))));
        });

        _this2.setState(_defineProperty({}, status, tasks));
      });
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      this.loadTasks('todo');
      this.loadTasks('pending');
      this.loadTasks('done');
    }
  }, {
    key: "render",
    value: function render() {
      return react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "container"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("h2", {
        className: "text-center my-3"
      }, "Tasks"), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        id: "tasksContainer"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "row"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        id: "todo",
        className: "col-sm-4"
      }, this.state.todo, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "loader"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "spinner-border",
        role: "status"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("span", {
        className: "sr-only"
      }, "Loading...")))), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        id: "pending",
        className: "col-sm-4"
      }, this.state.pending, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "loader"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "spinner-border",
        role: "status"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("span", {
        className: "sr-only"
      }, "Loading...")))), react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        id: "done",
        className: "col-sm-4"
      }, this.state.done, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "loader"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("div", {
        className: "spinner-border",
        role: "status"
      }, react__WEBPACK_IMPORTED_MODULE_13___default.a.createElement("span", {
        className: "sr-only"
      }, "Loading...")))))));
    }
  }]);

  return TasksIndex;
}(react__WEBPACK_IMPORTED_MODULE_13__["Component"]);



/***/ }),

/***/ "./assets/js/pages/users/UsersIndex.js":
/*!*********************************************!*\
  !*** ./assets/js/pages/users/UsersIndex.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.array.iterator */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.object.create */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.object.define-property */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.object.to-string */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_11__);












function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }



var UsersIndex =
/*#__PURE__*/
function (_React$Component) {
  _inherits(UsersIndex, _React$Component);

  function UsersIndex() {
    _classCallCheck(this, UsersIndex);

    return _possibleConstructorReturn(this, _getPrototypeOf(UsersIndex).apply(this, arguments));
  }

  _createClass(UsersIndex, [{
    key: "render",
    value: function render() {
      return react__WEBPACK_IMPORTED_MODULE_11___default.a.createElement("div", null, react__WEBPACK_IMPORTED_MODULE_11___default.a.createElement("p", null, "Users"));
    }
  }]);

  return UsersIndex;
}(react__WEBPACK_IMPORTED_MODULE_11___default.a.Component);

/* harmony default export */ __webpack_exports__["default"] = (UsersIndex);

/***/ }),

/***/ "./assets/js/utils.js":
/*!****************************!*\
  !*** ./assets/js/utils.js ***!
  \****************************/
/*! exports provided: dateToString */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "dateToString", function() { return dateToString; });
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.join */ "./node_modules/core-js/modules/es.array.join.js");
/* harmony import */ var core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_join__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.date.to-string */ "./node_modules/core-js/modules/es.date.to-string.js");
/* harmony import */ var core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_string__WEBPACK_IMPORTED_MODULE_1__);


function dateToString(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear(),
      hour = '' + d.getHours(),
      minute = '' + d.getMinutes(),
      second = '' + d.getSeconds();
  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;
  if (hour.length < 2) hour = '0' + hour;
  if (minute.length < 2) minute = '0' + minute;
  if (second.length < 2) second = '0' + second;
  return [year, month, day].join('-') + ' ' + [hour, minute, second].join(':');
}

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvQ29tcG9uZW50cy9BdXRoL0F1dGguanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL0NvbXBvbmVudHMvQXV0aC9BdXRoQnV0dG9uLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9Db21wb25lbnRzL0F1dGgvUHJpdmF0ZVJvdXRlLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9Db21wb25lbnRzL05hdmJhci5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9wYWdlcy9Ib21lLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9wYWdlcy9sb2dpbi9Mb2dpbi5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvcGFnZXMvcmVzdHJpY3RlZC9SZXN0cmljdGVkUGFnZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvcGFnZXMvdGFza3MvVGFza3NJbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvcGFnZXMvdXNlcnMvVXNlcnNJbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvdXRpbHMuanMiXSwibmFtZXMiOlsiQXV0aCIsImlzQXV0aGVudGljYXRlZCIsImxvY2FsU3RvcmFnZSIsImdldEl0ZW0iLCJhdXRoZW50aWNhdGUiLCJjYWxsYmFjayIsInNpZ25PdXQiLCJyZW1vdmVJdGVtIiwiQXV0aEJ1dHRvbiIsIndpdGhSb3V0ZXIiLCJoaXN0b3J5IiwiUHJpdmF0ZVJvdXRlIiwiQ29tcG9uZW50IiwiY29tcG9uZW50IiwicmVzdCIsInByb3BzIiwicGF0aG5hbWUiLCJzdGF0ZSIsImZyb20iLCJsb2NhdGlvbiIsIk5hdkJhciIsImNvbGxhcHNlIiwiaXNXaWRlRW5vdWdoIiwib25DbGljayIsImJpbmQiLCJzZXRTdGF0ZSIsImxpbmtzIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50c0J5Q2xhc3NOYW1lIiwibGluayIsIm9uY2xpY2siLCJlbGVtIiwicGFyZW50RWxlbWVudCIsImNsYXNzTGlzdCIsInJlbW92ZSIsImFkZCIsInRva2VuIiwiQXBwIiwiSG9tZSIsIlVzZXJzSW5kZXgiLCJUYXNrc0luZGV4IiwiTG9naW4iLCJSZXN0cmljdGVkUGFnZSIsIlJlYWN0IiwicmVuZGVyIiwiZ2V0RWxlbWVudEJ5SWQiLCJpc1Nob3dpbmdFcnJvciIsInVzZXJuYW1lIiwicGFzc3dvcmQiLCJyZWRpcmVjdFRvUmVmZXJlciIsImhhbmRsZUlucHV0Q2hhbmdlIiwiaGFuZGxlRm9ybVN1Ym1pdCIsImhhbmRsZUtleVByZXNzIiwiZSIsInByZXZlbnREZWZhdWx0IiwibG9naW5Gb3JtIiwidGFyZ2V0IiwiZmV0Y2giLCJnZXRBdHRyaWJ1dGUiLCJtZXRob2QiLCJoZWFkZXJzIiwiYm9keSIsIkpTT04iLCJzdHJpbmdpZnkiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwiY29kZSIsImxvZ2luRXJyb3JDb250YWluZXIiLCJpbm5lclRleHQiLCJtZXNzYWdlIiwiU3RvcmFnZSIsInNldEl0ZW0iLCJwdXNoIiwibmFtZSIsInZhbHVlIiwia2V5Q29kZSIsImVycm9yQ29udGFpbmVyIiwidG9kbyIsInBlbmRpbmciLCJkb25lIiwic3RhdHVzIiwibG9hZGVycyIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJsb2FkZXIiLCJ0YXNrcyIsIm1hcCIsInRhc2siLCJpZCIsImRhdGVUb1N0cmluZyIsImNyZWF0ZWRfYXQiLCJ1cGRhdGVkX2F0IiwidXNlciIsInByaW9yaXR5IiwidGl0bGUiLCJkZXNjcmlwdGlvbiIsImxvYWRUYXNrcyIsImRhdGUiLCJkIiwiRGF0ZSIsIm1vbnRoIiwiZ2V0TW9udGgiLCJkYXkiLCJnZXREYXRlIiwieWVhciIsImdldEZ1bGxZZWFyIiwiaG91ciIsImdldEhvdXJzIiwibWludXRlIiwiZ2V0TWludXRlcyIsInNlY29uZCIsImdldFNlY29uZHMiLCJsZW5ndGgiLCJqb2luIl0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7O0FBQUE7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QUFLLEdBQUcsTUFBTUYsQ0FBQyxDQUFDRyxRQUFGLEtBQWUsQ0FBckIsQ0FEWjtBQUFBLE1BRUlDLEdBQUcsR0FBRyxLQUFLSixDQUFDLENBQUNLLE9BQUYsRUFGZjtBQUFBLE1BR0lDLElBQUksR0FBR04sQ0FBQyxDQUFDTyxXQUFGLEVBSFg7QUFBQSxNQUlJQyxJQUFJLEdBQUcsS0FBS1IsQ0FBQyxDQUFDUyxRQUFGLEVBSmhCO0FBQUEsTUFLSUMsTUFBTSxHQUFHLEtBQUtWLENBQUMsQ0FBQ1csVUFBRixFQUxsQjtBQUFBLE1BTUlDLE1BQU0sR0FBRyxLQUFLWixDQUFDLENBQUNhLFVBQUYsRUFObEI7QUFRQSxNQUFJWCxLQUFLLENBQUNZLE1BQU4sR0FBZSxDQUFuQixFQUFzQlosS0FBSyxHQUFHLE1BQU1BLEtBQWQ7QUFDdEIsTUFBSUUsR0FBRyxDQUFDVSxNQUFKLEdBQWEsQ0FBakIsRUFBb0JWLEdBQUcsR0FBRyxNQUFNQSxHQUFaO0FBQ3BCLE1BQUlJLElBQUksQ0FBQ00sTUFBTCxHQUFjLENBQWxCLEVBQXFCTixJQUFJLEdBQUcsTUFBTUEsSUFBYjtBQUNyQixNQUFJRSxNQUFNLENBQUNJLE1BQVAsR0FBZ0IsQ0FBcEIsRUFBdUJKLE1BQU0sR0FBRyxNQUFNQSxNQUFmO0FBQ3ZCLE1BQUlFLE1BQU0sQ0FBQ0UsTUFBUCxHQUFnQixDQUFwQixFQUF1QkYsTUFBTSxHQUFHLE1BQU1BLE1BQWY7QUFFdkIsU0FBTyxDQUFDTixJQUFELEVBQU9KLEtBQVAsRUFBY0UsR0FBZCxFQUFtQlcsSUFBbkIsQ0FBd0IsR0FBeEIsSUFBK0IsR0FBL0IsR0FBcUMsQ0FBQ1AsSUFBRCxFQUFPRSxNQUFQLEVBQWVFLE1BQWYsRUFBdUJHLElBQXZCLENBQTRCLEdBQTVCLENBQTVDO0FBQ0gsQyIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyJjb25zdCBBdXRoID0ge1xuICAgIGlzQXV0aGVudGljYXRlZDogbG9jYWxTdG9yYWdlLmdldEl0ZW0oJ3Rva2VuJykgPyB0cnVlIDogZmFsc2UsXG5cbiAgICAvLyBUT0RPOiBDaGVjayBmb3IgdG9rZW4gZXZlcnkgbWludXRlXG4gICAgYXV0aGVudGljYXRlKGNhbGxiYWNrKSB7XG4gICAgICAgIC8vQWpheFxuICAgICAgICB0aGlzLmlzQXV0aGVudGljYXRlZCA9IHRydWU7XG4gICAgfSxcblxuICAgIHNpZ25PdXQoY2FsbGJhY2spIHtcbiAgICAgICAgdGhpcy5pc0F1dGhlbnRpY2F0ZWQgPSBmYWxzZTtcbiAgICAgICAgbG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oJ3Rva2VuJyk7XG4gICAgfVxufTtcblxuZXhwb3J0IGRlZmF1bHQgQXV0aDsiLCJpbXBvcnQge3dpdGhSb3V0ZXJ9IGZyb20gJ3JlYWN0LXJvdXRlci1kb20nO1xuaW1wb3J0IEF1dGggZnJvbSAnLi9BdXRoJztcbmltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5pbXBvcnQge05hdkxpbmt9IGZyb20gXCJtZGJyZWFjdFwiO1xuXG5jb25zdCBBdXRoQnV0dG9uID0gd2l0aFJvdXRlcihcbiAgICAoe2hpc3Rvcnl9KSA9PlxuICAgICAgICBBdXRoLmlzQXV0aGVudGljYXRlZCA/IChcbiAgICAgICAgICAgIDxOYXZMaW5rIHRvPVwiL2xvZ2luXCJcbiAgICAgICAgICAgICAgICAgICAgIG9uQ2xpY2s9eygpID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgICBBdXRoLnNpZ25PdXQoKTtcbiAgICAgICAgICAgICAgICAgICAgIH19XG4gICAgICAgICAgICA+XG4gICAgICAgICAgICAgICAgU2lnbiBvdXRcbiAgICAgICAgICAgIDwvTmF2TGluaz5cbiAgICAgICAgKSA6IDxOYXZMaW5rIHRvPVwiL2xvZ2luXCI+TG9naW48L05hdkxpbms+XG4pO1xuXG5leHBvcnQgZGVmYXVsdCBBdXRoQnV0dG9uOyIsImltcG9ydCB7IFJvdXRlLCBSZWRpcmVjdCB9IGZyb20gJ3JlYWN0LXJvdXRlci1kb20nO1xuaW1wb3J0IFJlYWN0LCB7Q29tcG9uZW50fSBmcm9tICdyZWFjdCc7XG5pbXBvcnQgQXV0aCBmcm9tICcuL0F1dGgnO1xuXG5mdW5jdGlvbiBQcml2YXRlUm91dGUoeyBjb21wb25lbnQ6IENvbXBvbmVudCwgLi4ucmVzdCB9KSB7XG4gICAgICAgIHJldHVybiA8Um91dGVcbiAgICAgICAgICAgIHsuLi5yZXN0fVxuICAgICAgICAgICAgcmVuZGVyID0geyAocHJvcHMpID0+IChcbiAgICAgICAgICAgIEF1dGguaXNBdXRoZW50aWNhdGVkID09PSB0cnVlIHx8IGxvY2FsU3RvcmFnZS5nZXRJdGVtKCd0b2tlbicpXG4gICAgICAgICAgICAgICAgPyA8Q29tcG9uZW50IHsuLi5wcm9wc30gLz5cbiAgICAgICAgICAgICAgICA6IDxSZWRpcmVjdCB0bz17e1xuICAgICAgICAgICAgICAgICAgICAgICAgcGF0aG5hbWU6IFwiL3Jlc3RyaWN0ZWRcIixcbiAgICAgICAgICAgICAgICAgICAgICAgIHN0YXRlOiB7ZnJvbTogcHJvcHMubG9jYXRpb259XG4gICAgICAgICAgICAgICAgfX0vPlxuICAgICAgICApfS8+XG59O1xuXG5leHBvcnQgZGVmYXVsdCBQcml2YXRlUm91dGU7IiwiaW1wb3J0IFJlYWN0LCB7Q29tcG9uZW50fSBmcm9tICdyZWFjdCc7XG5pbXBvcnQge1xuICAgIENvbGxhcHNlLFxuICAgIE5hdmJhcixcbiAgICBOYXZiYXJOYXYsXG4gICAgTmF2YmFyVG9nZ2xlcixcbiAgICBOYXZJdGVtLFxuICAgIE5hdkxpbmtcbn0gZnJvbSAnbWRicmVhY3QnO1xuaW1wb3J0IEF1dGhCdXR0b24gZnJvbSAnLi9BdXRoL0F1dGhCdXR0b24nO1xuXG5cbmNsYXNzIE5hdkJhciBleHRlbmRzIENvbXBvbmVudCB7XG4gICAgY29uc3RydWN0b3IocHJvcHMpIHtcbiAgICAgICAgc3VwZXIocHJvcHMpO1xuICAgICAgICB0aGlzLnN0YXRlID0ge1xuICAgICAgICAgICAgY29sbGFwc2U6IGZhbHNlLFxuICAgICAgICAgICAgaXNXaWRlRW5vdWdoOiBmYWxzZSxcbiAgICAgICAgfTtcbiAgICAgICAgdGhpcy5vbkNsaWNrID0gdGhpcy5vbkNsaWNrLmJpbmQodGhpcyk7XG4gICAgfVxuXG4gICAgb25DbGljaygpIHtcbiAgICAgICAgdGhpcy5zZXRTdGF0ZSh7XG4gICAgICAgICAgICBjb2xsYXBzZTogIXRoaXMuc3RhdGUuY29sbGFwc2UsXG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGNvbXBvbmVudERpZE1vdW50KCkge1xuICAgICAgICBsZXQgbGlua3MgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKCduYXYtbGluaycpO1xuXG4gICAgICAgIGZvciAobGV0IGxpbmsgb2YgbGlua3MpIHtcbiAgICAgICAgICAgIGxpbmsub25jbGljayA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBmb3IgKGxldCBlbGVtIG9mIGxpbmtzKSB7XG4gICAgICAgICAgICAgICAgICAgIGVsZW0ucGFyZW50RWxlbWVudC5jbGFzc0xpc3QucmVtb3ZlKCdhY3RpdmUnKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBsaW5rLnBhcmVudEVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnYWN0aXZlJyk7XG4gICAgICAgICAgICB9O1xuICAgICAgICB9XG4gICAgfVxuXG4gICAgcmVuZGVyKCkge1xuICAgICAgICByZXR1cm4gKFxuICAgICAgICAgICAgPE5hdmJhciBjb2xvcj1cIndoaXRlXCIgbGlnaHQgZXhwYW5kPVwibWRcIiBzY3JvbGxpbmc+XG4gICAgICAgICAgICAgICAgeyF0aGlzLnN0YXRlLmlzV2lkZUVub3VnaCAmJiA8TmF2YmFyVG9nZ2xlciBvbkNsaWNrPXt0aGlzLm9uQ2xpY2t9Lz59XG4gICAgICAgICAgICAgICAgPENvbGxhcHNlIGlzT3Blbj17dGhpcy5zdGF0ZS5jb2xsYXBzZX0gbmF2YmFyPlxuICAgICAgICAgICAgICAgICAgICA8TmF2YmFyTmF2IGxlZnQgPlxuICAgICAgICAgICAgICAgICAgICAgICAgPE5hdkl0ZW0+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPE5hdkxpbmsgdG89XCIvXCI+VGFzay1NYW5hZ2VyPC9OYXZMaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9OYXZJdGVtPlxuICAgICAgICAgICAgICAgICAgICAgICAgPE5hdkl0ZW0+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPE5hdkxpbmsgdG89XCIvdXNlcnNcIj5Vc2VyczwvTmF2TGluaz5cbiAgICAgICAgICAgICAgICAgICAgICAgIDwvTmF2SXRlbT5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxOYXZJdGVtPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxOYXZMaW5rIHRvPVwiL3Rhc2tzXCIgdG9rZW49e3RoaXMuc3RhdGUudG9rZW59PlRhc2tzPC9OYXZMaW5rPlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9OYXZJdGVtPlxuICAgICAgICAgICAgICAgICAgICAgICAgPE5hdkl0ZW0+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPEF1dGhCdXR0b24vPlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9OYXZJdGVtPlxuICAgICAgICAgICAgICAgICAgICA8L05hdmJhck5hdj5cbiAgICAgICAgICAgICAgICA8L0NvbGxhcHNlPlxuICAgICAgICAgICAgPC9OYXZiYXI+XG4gICAgICAgICk7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBOYXZCYXI7IiwiaW1wb3J0KCcuLi9jc3MvYXBwLnNjc3MnKTtcblxuaW1wb3J0ICdAZm9ydGF3ZXNvbWUvZm9udGF3ZXNvbWUtZnJlZS9jc3MvYWxsLm1pbi5jc3MnO1xuaW1wb3J0ICdib290c3RyYXAtY3NzLW9ubHkvY3NzL2Jvb3RzdHJhcC5taW4uY3NzJztcbmltcG9ydCAnbWRicmVhY3QvZGlzdC9jc3MvbWRiLmNzcyc7XG5cbmltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5pbXBvcnQgeyByZW5kZXIgfSBmcm9tICdyZWFjdC1kb20nO1xuaW1wb3J0IHtcbiAgICBCcm93c2VyUm91dGVyIGFzIFJvdXRlcixcbiAgICBTd2l0Y2gsXG4gICAgUm91dGVcbn0gZnJvbSBcInJlYWN0LXJvdXRlci1kb21cIjtcblxuaW1wb3J0IE5hdmJhciBmcm9tICcuL0NvbXBvbmVudHMvTmF2YmFyJztcbmltcG9ydCBQcml2YXRlUm91dGUgZnJvbSAnLi9Db21wb25lbnRzL0F1dGgvUHJpdmF0ZVJvdXRlJztcblxuaW1wb3J0IEhvbWUgZnJvbSAnLi9wYWdlcy9Ib21lJztcbmltcG9ydCBUYXNrc0luZGV4IGZyb20gJy4vcGFnZXMvdGFza3MvVGFza3NJbmRleCc7XG5pbXBvcnQgVXNlcnNJbmRleCBmcm9tICcuL3BhZ2VzL3VzZXJzL1VzZXJzSW5kZXgnO1xuaW1wb3J0IExvZ2luIGZyb20gJy4vcGFnZXMvbG9naW4vTG9naW4nO1xuaW1wb3J0IFJlc3RyaWN0ZWRQYWdlIGZyb20gICcuL3BhZ2VzL3Jlc3RyaWN0ZWQvUmVzdHJpY3RlZFBhZ2UnO1xuXG5jbGFzcyBBcHAgZXh0ZW5kcyBSZWFjdC5Db21wb25lbnQge1xuICAgIGNvbnN0cnVjdG9yKHByb3BzKSB7XG4gICAgICAgIHN1cGVyKHByb3BzKTtcbiAgICB9O1xuXG4gICAgcmVuZGVyKCkge1xuICAgICAgICByZXR1cm4gKFxuICAgICAgICAgICAgPFJvdXRlcj5cbiAgICAgICAgICAgICAgICA8TmF2YmFyLz5cbiAgICAgICAgICAgICAgICA8U3dpdGNoPlxuICAgICAgICAgICAgICAgICAgICA8UHJpdmF0ZVJvdXRlIHBhdGg9XCIvXCIgY29tcG9uZW50PXtIb21lfSBleGFjdC8+XG4gICAgICAgICAgICAgICAgICAgIDxQcml2YXRlUm91dGUgcGF0aD1cIi91c2Vyc1wiIGNvbXBvbmVudD17VXNlcnNJbmRleH0gLz5cbiAgICAgICAgICAgICAgICAgICAgPFByaXZhdGVSb3V0ZSBwYXRoPVwiL3Rhc2tzXCIgY29tcG9uZW50PXtUYXNrc0luZGV4fSAvPlxuICAgICAgICAgICAgICAgICAgICA8Um91dGUgcGF0aD1cIi9sb2dpblwiIGNvbXBvbmVudD17TG9naW59IC8+XG4gICAgICAgICAgICAgICAgICAgIDxSb3V0ZSBwYXRoPVwiL3Jlc3RyaWN0ZWRcIiBjb21wb25lbnQ9e1Jlc3RyaWN0ZWRQYWdlfSAvPlxuICAgICAgICAgICAgICAgIDwvU3dpdGNoPlxuICAgICAgICAgICAgPC9Sb3V0ZXI+XG4gICAgICAgICk7XG4gICAgfVxufVxuXG5yZW5kZXIoPEFwcCAvPiwgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Jvb3QnKSk7XG4iLCJpbXBvcnQgUmVhY3QgZnJvbSAncmVhY3QnO1xuXG5jb25zdCBIb21lID0gKCkgPT4ge1xuICAgIHJldHVybiAoXG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29udGFpbmVyXCI+XG4gICAgICAgICAgICA8aDEgY2xhc3NOYW1lPVwibXktM1wiPkhvbWUgcGFnZTwvaDE+XG5cbiAgICAgICAgICAgIDxwPldlbGNvbWUgdG8gdGFzayBtYW5hZ2VyPC9wPlxuICAgICAgICA8L2Rpdj5cbiAgICApO1xufTtcblxuZXhwb3J0IGRlZmF1bHQgSG9tZTsiLCJpbXBvcnQgUmVhY3QsIHtDb21wb25lbnR9IGZyb20gJ3JlYWN0JztcbmltcG9ydCB7TURCQ29udGFpbmVyLCBNREJSb3csIE1EQkNvbH0gZnJvbSAnbWRicmVhY3QnO1xuaW1wb3J0IEF1dGggZnJvbSAnLi4vLi4vQ29tcG9uZW50cy9BdXRoL0F1dGgnO1xuXG5jbGFzcyBMb2dpbiBleHRlbmRzIENvbXBvbmVudCB7XG4gICAgY29uc3RydWN0b3IocHJvcHMpIHtcbiAgICAgICAgc3VwZXIocHJvcHMpO1xuICAgICAgICB0aGlzLnN0YXRlID0ge1xuICAgICAgICAgICAgaXNTaG93aW5nRXJyb3I6IGZhbHNlLFxuICAgICAgICAgICAgdXNlcm5hbWU6ICcnLFxuICAgICAgICAgICAgcGFzc3dvcmQ6ICcnLFxuICAgICAgICAgICAgcmVkaXJlY3RUb1JlZmVyZXI6IGZhbHNlXG4gICAgICAgIH07XG5cbiAgICAgICAgdGhpcy5oYW5kbGVJbnB1dENoYW5nZSA9IHRoaXMuaGFuZGxlSW5wdXRDaGFuZ2UuYmluZCh0aGlzKTtcbiAgICAgICAgdGhpcy5oYW5kbGVGb3JtU3VibWl0ID0gdGhpcy5oYW5kbGVGb3JtU3VibWl0LmJpbmQodGhpcyk7XG4gICAgICAgIHRoaXMuaGFuZGxlS2V5UHJlc3MgPSB0aGlzLmhhbmRsZUtleVByZXNzLmJpbmQodGhpcyk7XG4gICAgfVxuXG4gICAgaGFuZGxlRm9ybVN1Ym1pdChlKSB7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgY29uc3QgbG9naW5Gb3JtID0gZS50YXJnZXQ7XG5cbiAgICAgICAgZmV0Y2gobG9naW5Gb3JtLmdldEF0dHJpYnV0ZSgnYWN0aW9uJyksIHtcbiAgICAgICAgICAgIG1ldGhvZDogJ3Bvc3QnLFxuICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICBcIkNvbnRlbnQtVHlwZVwiOiBcImFwcGxpY2F0aW9uL2pzb25cIlxuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KHtcbiAgICAgICAgICAgICAgICB1c2VybmFtZTogdGhpcy5zdGF0ZS51c2VybmFtZSxcbiAgICAgICAgICAgICAgICBwYXNzd29yZDogdGhpcy5zdGF0ZS5wYXNzd29yZFxuICAgICAgICAgICAgfSlcbiAgICAgICAgfSkudGhlbigocmVzcG9uc2UpID0+IHJlc3BvbnNlLmpzb24oKSlcbiAgICAgICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xuXG4gICAgICAgICAgICAgICAgLy8gSWYgdGhlcmUgaXMgYW4gYXV0aG9yaXNhdGlvbiBlcnJvclxuICAgICAgICAgICAgICAgIGlmIChyZXNwb25zZS5jb2RlID09PSA0MDEpIHtcbiAgICAgICAgICAgICAgICAgICAgLy8gU2hvdyBlcnJvclxuICAgICAgICAgICAgICAgICAgICB0aGlzLnNldFN0YXRlKHtpc1Nob3dpbmdFcnJvcjogdHJ1ZX0pO1xuICAgICAgICAgICAgICAgICAgICBjb25zdCBsb2dpbkVycm9yQ29udGFpbmVyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2xvZ2luRXJyb3JDb250YWluZXInKTtcbiAgICAgICAgICAgICAgICAgICAgbG9naW5FcnJvckNvbnRhaW5lci5pbm5lclRleHQgPSByZXNwb25zZS5tZXNzYWdlO1xuXG4gICAgICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAvLyBTYXZlIHRva2VuIHRvIGxvY2FsU3RvcmFnZVxuICAgICAgICAgICAgICAgIGlmICh0eXBlb2YgKFN0b3JhZ2UpICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgICAgICAgICAgICAgIGxvY2FsU3RvcmFnZS5zZXRJdGVtKFwidG9rZW5cIiwgcmVzcG9uc2UudG9rZW4pO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIC8vIEF1dGhvcmlzZVxuICAgICAgICAgICAgICAgIEF1dGguYXV0aGVudGljYXRlKCgpID0+IHtcbiAgICAgICAgICAgICAgICAgICB0aGlzLnNldFN0YXRlKCgpID0+ICh7XG4gICAgICAgICAgICAgICAgICAgICAgIHJlZGlyZWN0VG9SZWZlcmVyOiB0cnVlXG4gICAgICAgICAgICAgICAgICAgfSkpO1xuICAgICAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAgICAgLy8gUmVkaXJlY3QgdG8gaG9tZXBhZ2VcbiAgICAgICAgICAgICAgICB0aGlzLnByb3BzLmhpc3RvcnkucHVzaChcIi9cIik7XG4gICAgICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBoYW5kbGVJbnB1dENoYW5nZShlKSB7XG4gICAgICAgIHRoaXMuc2V0U3RhdGUoe1xuICAgICAgICAgICAgW2UudGFyZ2V0Lm5hbWVdOiBlLnRhcmdldC52YWx1ZVxuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBoYW5kbGVLZXlQcmVzcyhlKSB7XG4gICAgICAgIGlmIChlLmtleUNvZGUgPT09IDEzKSByZXR1cm4gdGhpcy5oYW5kbGVGb3JtU3VibWl0O1xuICAgIH1cblxuICAgIHJlbmRlcigpIHtcbiAgICAgICAgbGV0IGVycm9yQ29udGFpbmVyO1xuICAgICAgICBpZiAodGhpcy5zdGF0ZS5pc1Nob3dpbmdFcnJvcikge1xuICAgICAgICAgICAgZXJyb3JDb250YWluZXIgPSA8ZGl2IGNsYXNzTmFtZT1cImFsZXJ0IGFsZXJ0LWRhbmdlclwiIGlkPVwibG9naW5FcnJvckNvbnRhaW5lclwiPjwvZGl2PjtcbiAgICAgICAgfVxuXG4gICAgICAgIHJldHVybiAoXG4gICAgICAgICAgICA8TURCQ29udGFpbmVyPlxuICAgICAgICAgICAgICAgIDxNREJSb3cgY2VudGVyPlxuICAgICAgICAgICAgICAgICAgICA8TURCQ29sIG1kPVwiNlwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgPGZvcm0gbWV0aG9kPVwicG9zdFwiIGFjdGlvbj1cIi9sb2dpbl9jaGVja1wiIGNsYXNzTmFtZT1cImxvZ2luX19mb3JtXCIgb25TdWJtaXQ9e3RoaXMuaGFuZGxlRm9ybVN1Ym1pdH0+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAge2Vycm9yQ29udGFpbmVyfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxoMSBjbGFzc05hbWU9XCJoMyBteS0zIGZvbnQtd2VpZ2h0LW5vcm1hbFwiPlBsZWFzZSBzaWduIGluPC9oMT5cblxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiZm9ybS1ncm91cFwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8bGFiZWwgaHRtbEZvcj1cImlucHV0VXNlcm5hbWVcIiBjbGFzc05hbWU9XCJzci1vbmx5XCI+VXNlcm5hbWU8L2xhYmVsPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW5wdXQgdHlwZT1cInRleHRcIiBuYW1lPVwidXNlcm5hbWVcIiBpZD1cImlucHV0VXNlcm5hbWVcIlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY2xhc3NOYW1lPVwiZm9ybS1jb250cm9sXCJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHBsYWNlaG9sZGVyPVwiVXNlcm5hbWVcIiBhdXRvRm9jdXNcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG9uQ2hhbmdlPXt0aGlzLmhhbmRsZUlucHV0Q2hhbmdlfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgb25LZXlEb3duPXt0aGlzLmhhbmRsZUtleVByZXNzfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgcmVxdWlyZWRcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLz5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cblxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiZm9ybS1ncm91cFwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8bGFiZWwgaHRtbEZvcj1cImlucHV0UGFzc3dvcmRcIiBjbGFzc05hbWU9XCJzci1vbmx5XCI+UGFzc3dvcmQ8L2xhYmVsPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aW5wdXQgdHlwZT1cInBhc3N3b3JkXCIgbmFtZT1cInBhc3N3b3JkXCIgaWQ9XCJpbnB1dFBhc3N3b3JkXCIgY2xhc3NOYW1lPVwiZm9ybS1jb250cm9sXCJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHBsYWNlaG9sZGVyPVwiUGFzc3dvcmRcIlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgb25DaGFuZ2U9e3RoaXMuaGFuZGxlSW5wdXRDaGFuZ2V9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBvbktleURvd249e3RoaXMuaGFuZGxlS2V5UHJlc3N9XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXF1aXJlZC8+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImZvcm0tZ3JvdXBcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGJ1dHRvbiBjbGFzc05hbWU9XCJidG4gYnRuLWxnIGJ0bi1wcmltYXJ5XCIgdHlwZT1cInN1Ym1pdFwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgU2lnbiBpblxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2J1dHRvbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDwvZm9ybT5cbiAgICAgICAgICAgICAgICAgICAgPC9NREJDb2w+XG4gICAgICAgICAgICAgICAgPC9NREJSb3c+XG4gICAgICAgICAgICA8L01EQkNvbnRhaW5lcj5cbiAgICAgICAgKTtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IExvZ2luOyIsImltcG9ydCBSZWFjdCBmcm9tIFwicmVhY3RcIjtcbmltcG9ydCB7IHdpdGhSb3V0ZXIgfSBmcm9tICdyZWFjdC1yb3V0ZXItZG9tJztcbmltcG9ydCB7TURCQ29udGFpbmVyLCBNREJSb3csIE1EQkNvbCwgTURCQnRufSBmcm9tICdtZGJyZWFjdCc7XG5cbmNvbnN0IFJlc3RyaWN0ZWRQYWdlID0gd2l0aFJvdXRlcihcbiAgICAoeyBoaXN0b3J5IH0pID0+IChcbiAgICAgICAgPE1EQkNvbnRhaW5lcj5cbiAgICAgICAgICAgIDxNREJSb3cgY2VudGVyPlxuICAgICAgICAgICAgICAgIDxNREJDb2wgPlxuICAgICAgICAgICAgICAgICAgICA8cCBjbGFzc05hbWU9XCJteS0zXCI+WW91IG11c3QgbG9nIGluIHRvIHZpZXcgdGhlIHBhZ2U8L3A+XG4gICAgICAgICAgICAgICAgICAgICAgICA8TURCQnRuIGNvbG9yPVwicHJpbWFyeVwiIG9uQ2xpY2s9eygpID0+IGhpc3RvcnkucHVzaChcIi9sb2dpblwiKX0+TG9nIGluPC9NREJCdG4+XG4gICAgICAgICAgICAgICAgPC9NREJDb2w+XG4gICAgICAgICAgICA8L01EQlJvdz5cbiAgICAgICAgPC9NREJDb250YWluZXI+XG5cbikpO1xuXG5leHBvcnQgZGVmYXVsdCBSZXN0cmljdGVkUGFnZTtcbiIsImltcG9ydCBSZWFjdCwgeyBDb21wb25lbnQgfSBmcm9tICdyZWFjdCc7XG5pbXBvcnQgeyBkYXRlVG9TdHJpbmcgfSBmcm9tIFwiLi4vLi4vdXRpbHNcIjtcblxuZXhwb3J0IGRlZmF1bHQgY2xhc3MgVGFza3NJbmRleCBleHRlbmRzIENvbXBvbmVudCB7XG4gICAgY29uc3RydWN0b3IocHJvcHMpIHtcbiAgICAgICAgc3VwZXIocHJvcHMpO1xuICAgICAgICB0aGlzLnN0YXRlID0ge1xuICAgICAgICAgICAgdG9kbzogW10sXG4gICAgICAgICAgICBwZW5kaW5nOiBbXSxcbiAgICAgICAgICAgIGRvbmU6IFtdLFxuICAgICAgICB9XG4gICAgfTtcblxuICAgIGxvYWRUYXNrcyhzdGF0dXMpIHtcbiAgICAgICAgbGV0IGxvYWRlcnMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcubG9hZGVyJyk7XG4gICAgICAgIGxldCB0b2tlbiA9IGxvY2FsU3RvcmFnZS5nZXRJdGVtKCd0b2tlbicpO1xuXG4gICAgICAgIGZldGNoKGAvYXBpL3Rhc2tzP3N0YXR1cz0ke3N0YXR1c31gLCB7XG4gICAgICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAgICAgJ0F1dGhvcml6YXRpb24nOiBgQmVhcmVyICR7dG9rZW59YFxuICAgICAgICAgICAgfVxuICAgICAgICB9KS50aGVuKGZ1bmN0aW9uIChyZXNwb25zZSkge1xuICAgICAgICAgICAgcmV0dXJuIHJlc3BvbnNlLmpzb24oKTtcbiAgICAgICAgfSkudGhlbigocmVzcG9uc2UpID0+IHtcbiAgICAgICAgICAgIGZvciAodmFyIGxvYWRlciBvZiBsb2FkZXJzKSB7XG4gICAgICAgICAgICAgICAgbG9hZGVyLmNsYXNzTGlzdC5hZGQoJ2Qtbm9uZScpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgbGV0IHRhc2tzID0gcmVzcG9uc2UudGFza3MubWFwKCh0YXNrKSA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuKFxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGtleT17dGFzay5pZH0gY2xhc3NOYW1lPVwiY29sLXNtLTEyIG1iLTNcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY2FyZCB0ZXh0LWNlbnRlclwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwidGFza19fbWFpbl9oZWFkZXJcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0XCI+Q3JlYXRlZDogPHNwYW4gY2xhc3NOYW1lPVwidGFza19fZGF0ZVwiPiB7ZGF0ZVRvU3RyaW5nKHRhc2suY3JlYXRlZF9hdCl9PC9zcGFuPjwvcD5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0XCI+e3Rhc2sudXBkYXRlZF9hdCA9PT0gbnVsbCA/IFwiTm90IHVwZGF0ZWRcIiA6IGBVcGRhdGVkOiA8c3BhbiBjbGFzc05hbWU9XCJ0YXNrX19kYXRlXCI+IHtkYXRlVG9TdHJpbmcodGFzay51cGRhdGVkX2F0KX08L3NwYW4+YH08L3A+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJ0YXNrX19zZWNvbmRhcnlfaGVhZGVyXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxidXR0b24gY2xhc3NOYW1lPVwidGFza19fdGV4dF9idXR0b24gZGVsZXRlVGFza0J1dHRvblwiIGRhdGEtdGFzay1zdGF0dXM9XCJ7dGFzay5zdGF0dXN9XCJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBkYXRhLXRhc2staWQ9XCJ7dGFzay5pZH1cIj5EZWxldGVcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9idXR0b24+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxwIGNsYXNzTmFtZT1cImNhcmQtdGV4dFwiPnt0YXNrLnVzZXIgPT09IG51bGwgJiYgdGFzay5zdGF0dXMgPT09ICdUb2RvJyA/IDxidXR0b24gZGF0YS10YXNrLWlkPXt0YXNrLmlkfSBjbGFzc05hbWU9XCJhc3NpZ25UYXNrQnV0dG9uXCI+QXNzaWduIHRvIG1lPC9idXR0b24+IDogdGFzay51c2VyfTwvcD5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0XCI+UHJpb3JpdHk6IHt0YXNrLnByaW9yaXR5fTwvcD5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNhcmQtYm9keVwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8aDUgY2xhc3NOYW1lPVwiY2FyZC10aXRsZVwiPnt0YXNrLnRpdGxlfTwvaDU+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxwIGNsYXNzTmFtZT1cImNhcmQtdGV4dFwiPlN0YXR1czogPHNwYW4gY2xhc3NOYW1lPVwiZm9udC13ZWlnaHQtYm9sZFwiPnt0YXNrLnN0YXR1c308L3NwYW4+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvcD5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0XCI+e3Rhc2suZGVzY3JpcHRpb259PC9wPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8YnV0dG9uIGRhdGEtdGFzay1zdGF0dXM9XCIke3Rhc2suc3RhdHVzfVwiIGRhdGEtdGFzay1pZD1cIiR7dGFzay5pZH1cIlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzTmFtZT1cImJ0biBidG4tcHJpbWFyeSBjaGFuZ2VTdGF0dXNCdXR0b25cIj57dGFzay5zdGF0dXMgPT09IFwiVG9kb1wiID8gXCJNb3ZlIHRvIFBlbmRpbmdcIiA6IHRhc2suc3RhdHVzID09PSBcIlBlbmRpbmdcIiA/IFwiTW92ZSB0byBEb25lXCIgOiBcIk5lZWQgd29ya1wifTwvYnV0dG9uPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxuICAgICAgICAgICAgICAgIClcbiAgICAgICAgICAgIH0pO1xuICAgICAgICAgICAgdGhpcy5zZXRTdGF0ZSh7W3N0YXR1c106IHRhc2tzfSk7XG5cbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgY29tcG9uZW50RGlkTW91bnQoKSB7XG4gICAgICAgIHRoaXMubG9hZFRhc2tzKCd0b2RvJyk7XG4gICAgICAgIHRoaXMubG9hZFRhc2tzKCdwZW5kaW5nJyk7XG4gICAgICAgIHRoaXMubG9hZFRhc2tzKCdkb25lJyk7XG4gICAgfVxuXG4gICAgcmVuZGVyKCkge1xuICAgICAgICByZXR1cm4gKFxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJjb250YWluZXJcIj5cbiAgICAgICAgICAgICAgICA8aDIgY2xhc3NOYW1lPVwidGV4dC1jZW50ZXIgbXktM1wiPlRhc2tzPC9oMj5cbiAgICAgICAgICAgICAgICA8ZGl2IGlkPVwidGFza3NDb250YWluZXJcIj5cbiAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJyb3dcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgaWQ9XCJ0b2RvXCIgY2xhc3NOYW1lPVwiY29sLXNtLTRcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB7dGhpcy5zdGF0ZS50b2RvfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9hZGVyXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwic3Bpbm5lci1ib3JkZXJcIiByb2xlPVwic3RhdHVzXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzc05hbWU9XCJzci1vbmx5XCI+TG9hZGluZy4uLjwvc3Bhbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgaWQ9XCJwZW5kaW5nXCIgY2xhc3NOYW1lPVwiY29sLXNtLTRcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB7dGhpcy5zdGF0ZS5wZW5kaW5nfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9hZGVyXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwic3Bpbm5lci1ib3JkZXJcIiByb2xlPVwic3RhdHVzXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzc05hbWU9XCJzci1vbmx5XCI+TG9hZGluZy4uLjwvc3Bhbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgaWQ9XCJkb25lXCIgY2xhc3NOYW1lPVwiY29sLXNtLTRcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB7dGhpcy5zdGF0ZS5kb25lfVxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwibG9hZGVyXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwic3Bpbm5lci1ib3JkZXJcIiByb2xlPVwic3RhdHVzXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzc05hbWU9XCJzci1vbmx5XCI+TG9hZGluZy4uLjwvc3Bhbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICAgICAgPC9kaXY+XG4gICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgKTtcbiAgICB9O1xufSIsImltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5cbmNsYXNzIFVzZXJzSW5kZXggZXh0ZW5kcyBSZWFjdC5Db21wb25lbnQge1xuICAgIHJlbmRlcigpIHtcbiAgICAgICAgcmV0dXJuIChcbiAgICAgICAgICAgIDxkaXY+XG4gICAgICAgICAgICAgICAgPHA+VXNlcnM8L3A+XG4gICAgICAgICAgICA8L2Rpdj5cbiAgICAgICAgKTtcbiAgICB9XG59XG5leHBvcnQgZGVmYXVsdCBVc2Vyc0luZGV4OyIsImV4cG9ydCBmdW5jdGlvbiBkYXRlVG9TdHJpbmcoZGF0ZSkge1xuICAgIGxldCBkID0gbmV3IERhdGUoZGF0ZSksXG4gICAgICAgIG1vbnRoID0gJycgKyAoZC5nZXRNb250aCgpICsgMSksXG4gICAgICAgIGRheSA9ICcnICsgZC5nZXREYXRlKCksXG4gICAgICAgIHllYXIgPSBkLmdldEZ1bGxZZWFyKCksXG4gICAgICAgIGhvdXIgPSAnJyArIGQuZ2V0SG91cnMoKSxcbiAgICAgICAgbWludXRlID0gJycgKyBkLmdldE1pbnV0ZXMoKSxcbiAgICAgICAgc2Vjb25kID0gJycgKyBkLmdldFNlY29uZHMoKTtcblxuICAgIGlmIChtb250aC5sZW5ndGggPCAyKSBtb250aCA9ICcwJyArIG1vbnRoO1xuICAgIGlmIChkYXkubGVuZ3RoIDwgMikgZGF5ID0gJzAnICsgZGF5O1xuICAgIGlmIChob3VyLmxlbmd0aCA8IDIpIGhvdXIgPSAnMCcgKyBob3VyO1xuICAgIGlmIChtaW51dGUubGVuZ3RoIDwgMikgbWludXRlID0gJzAnICsgbWludXRlO1xuICAgIGlmIChzZWNvbmQubGVuZ3RoIDwgMikgc2Vjb25kID0gJzAnICsgc2Vjb25kO1xuXG4gICAgcmV0dXJuIFt5ZWFyLCBtb250aCwgZGF5XS5qb2luKCctJykgKyAnICcgKyBbaG91ciwgbWludXRlLCBzZWNvbmRdLmpvaW4oJzonKTtcbn1cblxuIl0sInNvdXJjZVJvb3QiOiIifQ==