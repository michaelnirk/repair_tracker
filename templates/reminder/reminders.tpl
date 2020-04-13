<link href="css/modules/reminder/reminders.css" rel="stylesheet">
<link href="css/jquery.datetimepicker.css" rel="stylesheet">
{strip}
  <div id='remindersWrapper'>
    <div id='formReminderWrapper' class='standard-form-wrapper'>
      <form id='reminderForm'>
        <div class='standard-form-element'>
          <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
          <label class='form-label' for='reminderText'>
            Reminder Text
          </label>
          <textarea id='reminderText' class='width3 auto-expand' name='reminder_text'></textarea>
        </div>
        <div class='standard-form-element reminder-email-unit'> 
          <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
          <label class='form-label'>
            Reminder Email Recipients
          </label>
          <select id="reminderEmails" class='width3 reminder-email' name="reminder_emails[]" multiple></select>
        </div>
        <div id="reminderDateUnitWrapper">
          <div class='standard-form-element reminder-date-unit'> 
            <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
            <label class='form-label'>
              Reminder Date
            </label>
            <input type='text' id="reminderDate" class='width2 reminder-date' placeholder='e.g. 29 Mar 2014'/>
            <input type='hidden' id='reminderDateAlt' class="reminder-date-alt"/>
            <i class="fas fa-trash-alt fa-fw standard-tooltip" title='Delete reminder date' onclick="Reminders.processDeleteReminderDateUnit(this);"></i>
            <i class="fas fa-plus-square fa-fw standard-tooltip" title="Add reminder date" onclick="Reminders.processAddReminderDateUnit();"></i>
          </div>
        </div>
        <div class='button-wrapper'>
          <button type='button' class='std-button standard-tooltip' title='Save reminder' onclick='Reminders.processSaveReminder();'>Save Reminder</button>
          <button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Reminders.hideForm();'>Cancel</button>
        </div>
        <input type="hidden" id="reminderID" name="reminder_id"/>
        <input type="hidden" id="reminderDatetimes" name="reminder_datetimes"/>
      </form>
    </div>
    <div id="listRemindersWrapper">
      <table class="table table-bordered whiteText" id='remindersTable'>
        <thead>
          <tr>
            <th>Reminder Text</th>
            <th>Reminder Dates</th>
            <th>Recipient Emails</th>
            <th>Date Created</th>
            <th></th>
          </tr>              
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  <script src='js/modules/reminder/reminders.js'></script>
  <script src='js/jquery.datetimepicker.full.min.js'></script>
  <script>
            $(document).ready(() => {
              const args = {
                reminders: {$reminders|@json_encode}
              };
              Reminders.init(args);
            });
  </script>
{/strip}