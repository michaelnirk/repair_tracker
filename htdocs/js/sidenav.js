SideNav = (function() {
  const _this = {};
    /***********************  Variables  ***************************/
    /***********************  end Variables  ***********************/
    
    /***********************  functions  ***************************/
    function showSideNav(e) {
      $("#sideNav").addClass("shown");
      e.stopPropagation();
      $(document).on('click.sideNav', e => {
        const sideNav = document.getElementById('sideNav');
        if (sideNav !== e.target && !sideNav.contains(e.target)) {
          hideSideNav();
        }
      });
    }
    
    function hideSideNav() {
      $(document).off('click.sideNav');
      $("#sideNav").removeClass("shown");
    }
    /***********************  end Functions  ***********************/
    
    /***********************  Exports  *****************************/
    _this.showSideNav = showSideNav;
    _this.hideSideNav = hideSideNav;
    /***********************  end Exports  *************************/
    return _this;
})();