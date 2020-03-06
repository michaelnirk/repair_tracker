{strip}
<div class='toolbar'>
  <div class='left'>
    <button type='button' 
            class='toolbar-button standard-tooltip back-button disabled' 
            title='Previous page' 
            onclick="window.history.back();"
    >
      <i class="fas fa-arrow-alt-left fa-fw"></i>
    </button>
    <button type='button' 
            class='toolbar-button standard-tooltip' 
            title='Create a new vehicle' 
            onclick="Vehicles.processAddVehicle();"
    >
      <i class="fas fa-plus fa-fw"></i>
    </button>
  </div>
</div>
{/strip}