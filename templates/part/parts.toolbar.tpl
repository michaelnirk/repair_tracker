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
            id='createPartButton'
            class='toolbar-button standard-tooltip' 
            title="Create a new part for this repair"
            onclick="Parts.processAddPart();"
    >
      <i class="fas fa-plus fa-fw"></i>
    </button>
    </a>
  </div>
</div>
{/strip}