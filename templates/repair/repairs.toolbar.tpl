{strip}
<div class='toolbar'>
  <div class='left'>
    <button type="button" 
            class='toolbar-button standard-tooltip back-button disabled' 
            title='Previous page' 
            onclick='window.history.back();'
    >
      <i class="fas fa-arrow-alt-left fa-fw"></i>
    </button>
    <button type="button" 
            id='createRepairButton'
            class='toolbar-button standard-tooltip' 
            title="Create a new repair for this vehicle"
            onclick="Repairs.processAddRepair();"
    >
      <i class="fas fa-plus fa-fw"></i>
    </button>
    </a>
  </div>
</div>
{/strip}