LinkController = (function() {
  const _this = {};
  /******************  Variables  ********************/
  
  /******************  end Variables  ****************/
  
  /******************  Functions  ********************/
  function editLinkTarget(element, items) {
    let href = element.attr('data-href');
    if (href.indexOf('?') === -1) {
      href += "?x=y";
    }
    for (const item in items) {
      href += `&${item}=${items[item]}`;
    }
    element.attr('data-href', href);
  }
  
  function buttonClickedAsLink(target, e) {
  const url = $(target).attr('data-href');
  if ((e.which === 1 && e.ctrlKey) || e.which === 2) {
    window.open(url, '_blank');
  } else {
    window.location.href = url;
  }
}
  /******************  end Functions  ****************/
  
  /******************  Exports  **********************/
  _this.editLinkTarget = editLinkTarget;
  _this.buttonClickedAsLink = buttonClickedAsLink;
  /******************  end Exports  ******************/
  return _this;
})();