<?php
/* Smarty version 3.1.30, created on 2020-05-01 12:44:44
  from "C:\develop\repair_tracker\templates\reminder\reminders.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5eac19bc578c50_44484607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9c660f8b7cc5a97c10630c2ef4ea4ab28e7c127' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\reminder\\reminders.tpl',
      1 => 1588336933,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5eac19bc578c50_44484607 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="css/modules/reminder/reminders.css" rel="stylesheet">
<link href="css/jquery.datetimepicker.css" rel="stylesheet">
<div id='remindersWrapper'><div id='formReminderWrapper' class='standard-form-wrapper'><form id='reminderForm'><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='reminderText'>Reminder Text</label><textarea id='reminderText' class='width3 auto-expand' name='reminder_text'></textarea></div><div class='standard-form-element reminder-email-unit'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label'>Reminder Email Recipients</label><select id="reminderEmails" class='width3 reminder-email' name="reminder_emails[]" multiple></select></div><div id="reminderDateUnitWrapper"><div class='standard-form-element reminder-date-unit'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label'>Reminder Date</label><input type='text' id="reminderDate" class='width2 reminder-date' placeholder='e.g. 29 Mar 2014'/><input type='hidden' id='reminderDateAlt' class="reminder-date-alt"/><i class="fas fa-trash-alt fa-fw standard-tooltip" title='Delete reminder date' onclick="Reminders.processDeleteReminderDateUnit(this);"></i><i class="fas fa-plus-square fa-fw standard-tooltip" title="Add reminder date" onclick="Reminders.processAddReminderDateUnit();"></i></div></div><div class='button-wrapper'><button type='button' class='std-button standard-tooltip' title='Save reminder' onclick='Reminders.processSaveReminder();'>Save Reminder</button><button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Reminders.hideForm();'>Cancel</button></div><input type="hidden" id="reminderID" name="reminder_id"/><input type="hidden" id="reminderDatetimes" name="reminder_datetimes"/></form></div><div id="listRemindersWrapper"><table class="table table-bordered whiteText" id='remindersTable'><thead><tr><th>Reminder Text</th><th>Reminder Dates</th><th>Recipient Emails</th><th>Date Created</th><th></th></tr></thead><tbody></tbody></table></div><div class='standard-form-element reminder-date-label-unit'><label class='form-label'>Reminder Date</label><div class="reminder-date-label width2"></div></div></div><?php echo '<script'; ?>
 src='js/modules/reminder/reminders.js'><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src='js/jquery.datetimepicker.full.min.js'><?php echo '</script'; ?>
><?php echo '<script'; ?>
>$(document).ready(() => {const args = {reminders: <?php echo json_encode($_smarty_tpl->tpl_vars['reminders']->value);?>
};Reminders.init(args);});<?php echo '</script'; ?>
><?php }
}
