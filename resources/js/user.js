// resources/js/user.js

// 1. Import jQuery from npm or legacy file
import $ from "jquery"; // or: const $ = require("./user/vendor/jquery.js");
window.$ = window.jQuery = $;

// 2. Import plugins (order matters)
require("./user/vendor/waypoints.js");
require("./user/bootstrap-bundle.js");

require("./user/slick.js");
require("./user/swiper-bundle.js");
require("./user/meanmenu.js");
require("./user/nice-select.js");
require("./user/magnific-popup.js");
require("./user/isotope-pkgd.js");
require("./user/imagesloaded-pkgd.js");
require("./user/wow.js");
require("./user/purecounter.js");
require("./user/parallax.js");
require("./user/range-slider.js");
require("./user/infinite-scroll.js");
require("./user/countdown.js");
require("./user/btnloadmore.js");
require("./user/ajax-form.js");

// 3. LAST → main.js
require("./user/main.js");

console.log("Shofy user.js loaded");
