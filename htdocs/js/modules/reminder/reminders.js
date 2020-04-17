Reminders = (function() {
  const _this = {};
  /***********************  Variables  ***************************/
  let user;
  let reminder;
  let table;
  const dateTimePickerOptions = {
    format: 'DD MMM YYYY HH:mm',
    formatTime: 'HH:mm',
    formatDate: 'DD MMM YYYY',
    minDate: 0,
    step: 15
  };
  const select2Options = {
    tags: true
  };
  let reminderDateDummy;
  let reminderEmailDummy;
  const errors = [];
  const tableOptions = {
    autoWidth: false,
    order: [[3, 'desc']],
    columnDefs: [
      {
        targets: 0,
        width: "40%",
        data: 'reminder_text',
        className: "text-left"
      },
      {
        targets: 1,
        width: "15%",
        className: 'text-center',
        render: function(data, type, row) {
          const formattedDates = [];
          for (const item of row.reminder_datetimes) {
            if (parseInt(item.is_sent, 10)) {
              formattedDates.push(`<span class='past-remind-date standard-tooltip' title='This reminder has been sent at this date and time.'>${moment(item.remind_datetime).format('DD MMM YYYY HH:mm')}</span>`);
            } else {
              formattedDates.push(`<span>${moment(item.remind_datetime).format('DD MMM YYYY HH:mm')}</span>`);
            }
          }
          return formattedDates.join('<br>');
        }
      },
      {
        targets: 2,
        width: "20%",
        className: 'text-center',
        render: function(data, type, row) {
          const reminder_emails = [];
          for (const item of row.reminder_emails) {
            reminder_emails.push(item.email);
          }
          return reminder_emails.join('<br>');
        }
      },
      {
        targets: 3,
        width: "15%",
        data: 'create_datetime',
        className: 'text-center',
        render: function(data, type, row) {
          if (type === 'display') {
            return moment(row.create_datetime).format('DD MMM YYYY HH:mm');
          } else {
            return data;
          }
        }
      },
      {
        targets: 4,
        width: "10%",
        className: "all-center",
        render: function(data, type, row) {
          //If the reminder has no remind dates that are not already past then inactivate the edit button
          let buttonClass = 'disabled';
          for (const reminderDate of row.reminder_datetimes) {
            if (!parseInt(reminderDate.is_sent, 10)) {
              buttonClass = '';
              break;
            }
          }
          return `<div class='table-function-icons-wrapper'>
                    <i class="fas fa-edit fa-fw standard-tooltip ${buttonClass}" title='Edit reminder' onclick='Reminders.processEditReminder(${row.reminder_id});'></i>
                    <i class="fas fa-trash-alt fa-fw standard-tooltip ${buttonClass}" title='Delete reminder' onclick='Reminders.processDeleteReminder(${row.reminder_id});'></i>
                  </div>`;
        }
      },
      {orderable: false, sortable: false, targets: 4}
    ],
    createdRow: function(row, data) {
      $(row).attr('id', `${data.reminder_id}`);
    },
    drawCallback: function() {
      initializeStandardTooltip();
    }
  };
  /***********************  end Variables  ***********************/

  /***********************  Functions  ***************************/
  async function init(args) {
    $.datetimepicker.setDateFormatter('moment');
    reminderDateDummy = $(".reminder-date-unit").first().clone();
    reminderEmailDummy = $(".reminder-email-unit").first().clone();
    $(document).on('change.reminderDate', '.reminder-date', function(event) {
      const target = $(event.target);
      if (target.val()) {
        target.next('input.reminder-date-alt').val(moment(target.val(), 'DD MMM YYYY HH:mm').format('YYYY-MM-DD HH:mm'));
      } else {
        target.next('input.reminder-date-alt').val("");
      }
    });
    
    $("#reminderDate").datetimepicker(dateTimePickerOptions);
    user = await Session.getItem("user");
    $("#reminderEmails").select2($.extend({}, select2Options, {data: [{id: user.email, text: user.email}]}));
    evaluateReminderDateButtons();
    tableOptions.data = args.reminders;
    table = $("#remindersTable").DataTable(tableOptions);
    evaluateBackButton();
  }

  function processAddReminder() {
    let proceed = true;
    if (reminder) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (!result) {
          proceed = false;
        }
      });
    }
    if (proceed) {
      clearForm();
      showForm();
      setPageTitle('Add New Reminder');
    }
  }

  function showForm() {
    $('#formReminderWrapper').slideDown(600, () => {
      $("textarea.auto-expand").each(function() {
        if (this.value) {
          this.style.height = this.scrollHeight + 10 + "px";
        }
      });
      $('div.content').animate({
        scrollTop: $("div.content").offset().top
      }, 600);
    });
  }

  function hideForm() {
    $('#formReminderWrapper').slideUp(600, () => {
      setPageTitle(`Manage Reminders`);
      clearForm();
    });
  }

  function clearForm() {
    reminder = null;
    $('#reminderText').val('');
    $(".reminder-date-unit", "#reminderDateUnitWrapper").not(':first').remove();
    $("#reminderDate").val('');
    $("#reminderDateAlt").val('').removeAttr('data-remind_datetime_id');
    $("#reminderEmails").empty().select2($.extend({}, select2Options, {data: [{id: user.email, text: user.email}]})).val('');
  }


  function processAddReminderDateUnit(datetime, remindDatetimeID) {
    const dateUnit = reminderDateDummy.clone();
    const now = Date.now();
    $("input.reminder-date", dateUnit).attr("id", `reminderDate${now}`);
    $("input.reminder-date-alt", dateUnit).attr("id", `reminderDateAlt${now}`);
    $("#reminderDateUnitWrapper").append(dateUnit);
    $(`#reminderDate${now}`).datetimepicker(dateTimePickerOptions);
    if (datetime) {
      $(`#reminderDate${now}`).val(moment(datetime).format("DD MMM YYYY HH:mm")).trigger('change.reminderDate');
      $(`#reminderDateAlt${now}`).attr('data-remind_datetime_id', remindDatetimeID);
    }
    evaluateReminderDateButtons();
  }

  function processDeleteReminderDateUnit(target) {
    $(target).closest("div.reminder-date-unit").remove();
    evaluateReminderDateButtons();
  }

  function evaluateReminderDateButtons() {
    $("i.fa-plus-square", ".reminder-date-unit").not(':last').addClass('hidden');
    $("i.fa-plus-square", ".reminder-date-unit").last().removeClass('hidden');
    if ($(".reminder-date-unit").length > 1) {
      $("i.fa-trash-alt", ".reminder-date-unit").removeClass('hidden');
    } else {
      $("i.fa-trash-alt", ".reminder-date-unit").addClass('hidden');
    }
  }

  async function processSaveReminder() {
    if (await validateForm()) {
      if (reminder) {
        $('#reminderID').val(reminder.reminder_id);
      }
      //Gather reminder dates
      const reminderDates = [];
      $('input.reminder-date-alt').each(function() {
        const id = $(this).attr('data-remind_datetime_id');
        reminderDates.push({
          remind_datetime_id: id,
          remind_datetime: this.value
        });
      });
      $("#reminderDatetimes").val(JSON.stringify(reminderDates));
      const reminderFormData = new FormData(reminderForm);
      $.ajax({
        url: 'index.php?module=reminder&action=set_reminder',
        processData: false,
        contentType: false,
        type: 'post',
        data: reminderFormData,
        beforeSend: function() {
          showWorking();
        }
      }).done(result => {
        result = JSON.parse(result);
        if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
          const reminderData = result.data;
          table.row(`#${reminderData.reminder_id}`).remove();
          table.row.add(reminderData).draw();
          const message = reminder ? "The reminder was successfully updated!" : "The reminder was successfully created!";
          displayMessage([message]);
//          clearForm();
          hideForm();
        } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
          if (result.hasOwnProperty('reason') && result.reason.hasOwnProperty('errors') && result.reason.errors.length) {
            errors.length = 0;
            const title = 'There are errors!';
            const message = result.reason.errors.join('<br>');
            showMessage(title, message);
          }
        } else {
          console.error(`Error setting reminder: ${result}`);
          const title = 'Error!';
          const message = 'An error has occurred. The reminder could not be successfully saved.';
          showMessage(title, message);
        }
      }).fail((xhr, text, error) => {
        console.error(`Error setting reminder: ${error}`);
        const title = 'Error!';
        const message = 'An error has occurred. The reminder could not be successfully saved.';
        showMessage(title, message);
      }).always(() => {
        hideWorking();
      });
    }
  }

  function validateForm() {
    errors.length = 0;
    let isValid = true;

    const text = $("#reminderText");
    const textVal = text.val().trim();
    if (textVal) {
      text.removeClass("invalid");
    } else {
      isValid = false;
      errors.push("Please enter reminder text");
      text.addClass("invalid");
    }

    const emails = $("#reminderEmails");
    const emailsVal = emails.val();
    const emailsContainer = $(".select2-selection", ".reminder-email-unit");
    if (emailsVal.length) {
      emailsContainer.removeClass("invalid");
    } else {
      isValid = false;
      errors.push("Please select at least 1 email address");
      emailsContainer.addClass("invalid");
    }

    let dateCount = 0;
    $(".reminder-date", "#reminderDateUnitWrapper").each(function() {
      if (this.value) {
        dateCount++;
      }
    });
    if (dateCount) {
      $(".reminder-date").removeClass('invalid');
    } else {
      isValid = false;
      errors.push("Please select at least 1 date");
      $(".reminder-date").addClass("invalid");
    }

    if (!isValid) {
      const title = "There are errors!";
      let message = errors.join("<br>");
      showMessage(title, message);
    }
    return isValid;
  }

  function processDeleteReminder(reminderID) {
    const title = 'Are you sure?';
    const message = 'Do you really want to delete this reminder?';
    showVerificationMessage(title, message).then(result => {
      if (result) {
        deleteReminder(reminderID);
      }
    });
  }

  function deleteReminder(reminderID) {
    $.ajax({
      url: 'index.php',
      data: {
        module: 'reminder',
        action: 'delete_reminder',
        reminder_id: reminderID
      },
      beforeSend: function() {
        showWorking();
      }
    }).done(result => {
      result = JSON.parse(result);
      if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
        if (parseInt(result.data, 10) === parseInt(reminderID, 10)) {
          table.row(`#${reminderID}`).remove().draw();
          const message = "Reminder was successfully deleted!";
          displayMessage([message]);
        }
      } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
        if (result.hasOwnProperty('reason') && result.reason.hasOwnProperty('errors') && result.reason.errors.length) {
          errors.length = 0;
          const title = 'There are errors!';
          const message = result.reason.errors.join('<br>');
          showMessage(title, message);
        }
      } else {
        console.error(`Error deleting reminder: ${result}`);
        const title = 'Error!';
        const message = 'An error has occurred. The reminder could not be deleted.';
        showMessage(title, message);
      }
    }).fail((xhr, text, error) => {
      console.error(`Error deleting reminder: ${error}`);
      const title = 'Error!';
      const message = 'An error has occurred. The reminder could not be deleted.';
      showMessage(title, message);
    }).always(() => {
      hideWorking();
    });
  }
  
  function processEditReminder(reminderID) {
    if (reminder) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (result) {
          clearForm();
          editReminder(reminderID);
        }
      });
    } else {
      editReminder(reminderID);
    }
  }

  function editReminder(reminderID) {
    reminder = table.row(`#${reminderID}`).data();
    setPageTitle(`Edit Reminder`);
    fillForm(reminder);
    showForm();
  }

  function fillForm() {
    $('#reminderText').val(reminder.reminder_text);
    const options = [];
    const emails = [];
    for (const item of reminder.reminder_emails) {
      options.push({id: item.email, text: item.email});
      emails.push(item.email);
    }
    $("#reminderEmails").empty().select2($.extend({}, select2Options, {data: options})).val(emails).trigger('change');
    //Fill reminder dates, but only dates that have not passed can be edited
    let editDateCount = 0;
    for (const reminderDate of reminder.reminder_datetimes) {
      if (parseInt(reminderDate.is_sent, 10)) {
        continue;
      }
      if (editDateCount === 0) {
        $("#reminderDate").val( moment(reminderDate.remind_datetime).format("DD MMM YYYY HH:mm")).trigger('change.reminderDate');
        $("#reminderDateAlt").attr('data-remind_datetime_id', reminderDate.remind_datetime_id);
      } else {
        processAddReminderDateUnit(reminderDate.remind_datetime, reminderDate.remind_datetime_id);
      }
      editDateCount++;
    }
  }

  /***********************  end Functions  ***********************/

  /***********************  Exports  *****************************/
  _this.init = init;
  _this.processAddReminder = processAddReminder;
  _this.hideForm = hideForm;
  _this.processAddReminderDateUnit = processAddReminderDateUnit;
  _this.processDeleteReminderDateUnit = processDeleteReminderDateUnit;
  _this.processSaveReminder = processSaveReminder;
  _this.processDeleteReminder = processDeleteReminder;
  _this.processEditReminder = processEditReminder;
  /***********************  end Exports  *************************/
  return _this;
})();

