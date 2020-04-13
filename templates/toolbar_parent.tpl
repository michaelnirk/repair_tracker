{strip}
  <link href="css/menu.css" rel="stylesheet">
  <div class='toolbar'>
    <div class='left'>
      {block name=leftContent}{/block}
    </div>
  <div class="right">
    <div id='menuWrapper'>
      <button type="button" class="toolbar-button standard-tooltip" title='Show menu' onclick="SideNav.showSideNav(event);">
        <i class="fas fa-bars fa-fw"></i>
      </button>
    </div>
  </div>
</div>
{/strip}