window._ = require("lodash");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js');
require('./nepali-datepicker')
window.bootstrap = require('bootstrap');
require('./jquery-ui')
require('./main')
require('./select2')
require('./utils')
require('./date')
require('./controlled-input')
require('./control-others')
require('./selector-importer')
