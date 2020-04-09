(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $(".menu-icon").on("click", function () {
    $("nav ul").toggleClass("showing");
  });
}); // Scrolling Effect

$(window).on("scroll", function () {
  if ($(window).scrollTop()) {
    $('nav').addClass('black');
  } else {
    $('nav').removeClass('black');
  }
});

/***/ })

},[["./assets/js/app.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvYXBwLmpzIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwib24iLCJ0b2dnbGVDbGFzcyIsIndpbmRvdyIsInNjcm9sbFRvcCIsImFkZENsYXNzIiwicmVtb3ZlQ2xhc3MiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7OztBQUFBQSxDQUFDLENBQUNDLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVc7QUFDekJGLEdBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JHLEVBQWhCLENBQW1CLE9BQW5CLEVBQTRCLFlBQVc7QUFDbkNILEtBQUMsQ0FBQyxRQUFELENBQUQsQ0FBWUksV0FBWixDQUF3QixTQUF4QjtBQUNILEdBRkQ7QUFHSCxDQUpELEUsQ0FNQTs7QUFFQUosQ0FBQyxDQUFDSyxNQUFELENBQUQsQ0FBVUYsRUFBVixDQUFhLFFBQWIsRUFBdUIsWUFBVztBQUM5QixNQUFHSCxDQUFDLENBQUNLLE1BQUQsQ0FBRCxDQUFVQyxTQUFWLEVBQUgsRUFBMEI7QUFDdEJOLEtBQUMsQ0FBQyxLQUFELENBQUQsQ0FBU08sUUFBVCxDQUFrQixPQUFsQjtBQUNILEdBRkQsTUFJSztBQUNEUCxLQUFDLENBQUMsS0FBRCxDQUFELENBQVNRLFdBQVQsQ0FBcUIsT0FBckI7QUFDSDtBQUNKLENBUkQsRSIsImZpbGUiOiJhcHAuanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgICQoXCIubWVudS1pY29uXCIpLm9uKFwiY2xpY2tcIiwgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgJChcIm5hdiB1bFwiKS50b2dnbGVDbGFzcyhcInNob3dpbmdcIik7XHJcbiAgICB9KTtcclxufSk7XHJcblxyXG4vLyBTY3JvbGxpbmcgRWZmZWN0XHJcblxyXG4kKHdpbmRvdykub24oXCJzY3JvbGxcIiwgZnVuY3Rpb24oKSB7XHJcbiAgICBpZigkKHdpbmRvdykuc2Nyb2xsVG9wKCkpIHtcclxuICAgICAgICAkKCduYXYnKS5hZGRDbGFzcygnYmxhY2snKTtcclxuICAgIH1cclxuXHJcbiAgICBlbHNlIHtcclxuICAgICAgICAkKCduYXYnKS5yZW1vdmVDbGFzcygnYmxhY2snKTtcclxuICAgIH1cclxufSkiXSwic291cmNlUm9vdCI6IiJ9