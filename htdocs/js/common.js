Common = (function() {
  let _this = {};
  let user;

  function setUser(arg) {
    user = arg;
  }

  function init() {
    if (!user) {
      $('.banner-element.right').addClass('hidden');
    }
    //Auto expand for textareas with the auto-expand class
    $(document).on('keyup.auto-expand', 'textarea.auto-expand', function() {
      autoresize(this);
    });
  }
  _this.setUser = setUser;
  _this.init = init;
  init();
  return _this;
})();