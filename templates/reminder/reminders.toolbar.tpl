{extends file='toolbar_parent.tpl'}
{block name=leftContent}
  <button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();'>
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type="button" id='createReminderButton' class='toolbar-button standard-tooltip' title="Create a new reminder" onclick="Reminders.processAddReminder();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
{/block}