{extends file='toolbar_parent.tpl'}
{block name=leftContent}
  <button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();'>
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type="button" class='toolbar-button standard-tooltip' title="Vehicle Repair List" onclick="Parts.showRepairsList();">
    <i class="fas fa-car-mechanic fa-fw"></i>
  </button>
  <button type="button" id='createPartButton' class='toolbar-button standard-tooltip' title="Create a new part for this repair" onclick="Parts.processAddPart();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
{/block}