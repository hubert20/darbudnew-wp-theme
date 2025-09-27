require("bootstrap");
(function () {
  // Add data-toggle to link menu
  var menuItem = document.querySelector('#menu-item-194 a');
  if (menuItem) {
    menuItem.setAttribute('data-bs-toggle', 'modal');
    menuItem.setAttribute('data-bs-target', '#offerformModal');
    menuItem.setAttribute('data-category', 'form-basic');
  }
})();