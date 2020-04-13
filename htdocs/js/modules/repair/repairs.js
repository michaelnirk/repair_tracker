Repairs = (function() {
  const _this = {};
  /************************  Variables  *************************/
  let vehicle;
  let repair;
  const dateTimePickerOptions = {
    altField: '#repairDateHidden',
    altFormat: 'yy-mm-dd',
    dateFormat: 'dd M yy',
    changeMonth: true,
    changeYear: true
  };
  let noteTemplate;
  const errors = [];
  let currencyData;
  let table;
  const tableOptions = {
    autoWidth: false,
    order: [[1, 'desc']],
    columnDefs: [
      {width: "45%", targets: 0},
      {width: "10%", targets: 1},
      {width: "10%", targets: 2},
      {width: "15%", targets: 3},
      {width: "10%", targets: 4},
      {width: "10%", targets: 5},
      {orderable: false, sortable: false, targets: 5}
    ],
    columns: [
      {
        data: "description",
        className: "text-left",
        render: function(data) {
          return data;
        }
      },
      {
        data: "repair_date",
        className: "text-center",
        render: function(data, type) {
          if (type === "display") {
            let content = "";
            if (data) {
              return moment(data).format("DD MMM YYYY");
            }
            return content;
          } else {
            return data;
          }
        }
      },
      {
        data: "km_at_repair",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "repair_location",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "repair_cost",
        className: "text-center",
        render: function(data, type, row) {
          if (type === 'display') {
            let content = "";
            if (data) {
              if (currencyData[row.repair_cost_currency].currency_symbol_position === '1') {//Before value
                content = `${currencyData[row.repair_cost_currency].html_entity}${data}`;
              } else {//After value
                contenyt = `${data} ${currencyData[row.repair_cost_currency].html_entity}`;
              }
            }
            return content;
          } else {
            return data;
          }
        }
      },
      {
        data: null,
        className: "all-center",
        render: function(data, type, row) {
          const partCount = row.part_count;
          const partCountTitle = (partCount === '1') ? 'part' : 'parts';
          const editRepairIcon = `<i class="fas fa-edit fa-fw standard-tooltip" title='Edit repair' onclick='Repairs.processEditRepair(${row.repair_id});'></i>`;
          const viewRepairPartsIcon = `<a href='index.php?module=part&action=parts&repair_id=${row.repair_id}'>
                                         <div class='icon-with-count'>
                                          <i class="fas fa-cogs fa-fw standard-tooltip" title='View repair parts'></i>
                                          <div class='icon-count standard-tooltip' title='This repair has ${partCount} ${partCountTitle}'>
                                            ${partCount}
                                          </div>
                                         </div>
                                       </a>`;
          const deleteRepairIcon = `<i class="fas fa-trash-alt fa-fw standard-tooltip" title='Delete repair' onclick='Repairs.processDeleteRepair(${row.repair_id});'></i>`;
          return `<div class='table-function-icons-wrapper'>${editRepairIcon}${viewRepairPartsIcon}${deleteRepairIcon}</div>`;
        }
      }
    ],
    createdRow: function(row, data) {
      $(row).attr('id', `${data.repair_id}`);
    },
    drawCallback: function() {
      initializeStandardTooltip();
    }
  };

  /************************  end Variables  *********************/

  /************************  Functions  *************************/
  async function init(args) {
    currencyData = await Session.getItem("currencyData");
    populateCurrencySelect();
    vehicle = args.vehicle;
    tableOptions.data = args.repairs;
    table = $("#repairsTable").DataTable(tableOptions);
    $("#repairDate").datepicker(dateTimePickerOptions);
    evaluateBackButton();
    //Create template for notes
    const noteTemplateElement = $('div.note.new');
    noteTemplate = noteTemplateElement.first().clone();
    noteTemplateElement.remove();
    noteTemplate.removeClass('new');
    initializeStandardTooltip();
  }
  
  function populateCurrencySelect() {
    const select = $("#repairCostCurrency");
    for (const currencySymbolID in currencyData) {
        select.append(new Option(currencyData[currencySymbolID].currency_symbol, currencySymbolID)
      );
    }
  }

  function processEditRepair(repairID) {
    if (repair) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (result) {
          clearForm();
          editRepair(repairID);
        }
      });
    } else {
      editRepair(repairID);
    }
  }

  function editRepair(repairID) {
    repair = table.row(`#${repairID}`).data();
    setPageTitle(`Edit Repair`);
    fillForm(repair);
    showForm();
  }

  function fillForm() {
    $("#repairDate").datepicker('setDate', moment(repair.repair_date).format("DD MMM YYYY")).trigger("change");
    $('#description').val(repair.description);
    $('#kmAtRepair').val(repair.km_at_repair ? repair.km_at_repair : '');
    $('#repairLocation').val(repair.repair_location ? repair.repair_location : '');
    if (repair.repair_cost) {
      $('#repairCost').val(repair.repair_cost);
      $("#repairCostCurrency").val(repair.repair_cost_currency);
    }
    if (repair.notes && repair.notes.length) {
      for (const note of repair.notes) {
        addNote(note);
      }
    }
  }

  function processAddRepair() {
    let proceed = true;
    if (repair) {
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
      setPageTitle('Add New Repair');
    }
  }

  function showForm() {
    $('#formRepairWrapper').slideDown(600, () => {
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
    $('#formRepairWrapper').slideUp(600, () => {
      setPageTitle(`${vehicle.name} - Repairs`);
      clearForm();
    });
  }

  function clearForm() {
    repair = null;
    $("#repairDate").datepicker('setDate', null);
    $("#repairDateHidden").val('');
    $('#description').val('');
    $('#kmAtRepair').val('');
    $('#repairLocation').val('');
    $('#repairCost').val('');
    $('#repairCostCurrency').val('');
    $("#repairNotesWrapper").empty();
  }

  async function processSaveRepair() {
    if (await validateForm()) {
      //Gather all notes
      const notes = [];
      $(".standard-form-element.note").each(function() {
        const note = {
          note_id: $(this).attr('id'),
          note_text: `${$("textarea", $(this)).val()}`

        };
        notes.push(note);
      });
      $("#notes").val(JSON.stringify(notes));
      $('#vehicleID').val(vehicle.vehicle_id);
      if (repair) {
        $('#repairID').val(repair.repair_id);
      }
      const repairFormData = new FormData(repairForm);
      $.ajax({
        url: 'index.php?module=repair&action=set_repair',
        processData: false,
        contentType: false,
        type: 'post',
        data: repairFormData,
        beforeSend: function() {
          showWorking();
        }
      }).done(result => {
        result = JSON.parse(result);
        if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
          const repairData = result.data;
          table.row(`#${repairData.repair_id}`).remove();
          table.row.add(repairData).draw();
          const message = repair ? "Repair information was successfully updated!" : "The repair was successfully created!";
          displayMessage([message]);
          hideForm();
        } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
          if (result.hasOwnProperty('reason') && result.reason.hasOwnProperty('errors') && result.reason.errors.length) {
            errors.length = 0;
            const title = 'There are errors!';
            const message = result.reason.errors.join('<br>');
            showMessage(title, message);
          }
        } else {
          console.error(`Error setting repair: ${result}`);
          const title = 'Error!';
          const message = 'An error has occurred. The repair data could not be successfully saved.';
          showMessage(title, message);
        }
      }).fail((xhr, text, error) => {
        console.error(`Error setting repair: ${error}`);
        const title = 'Error!';
        const message = 'An error has occurred. The repair data could not be successfully saved.';
        showMessage(title, message);
      }).always(() => {
        hideWorking();
      });
    }
  }

  function validateForm() {
    errors.length = 0;
    let isValid = true;

    const repairDate = $("#repairDate");
    if (repairDate.val().trim()) {
      repairDate.removeClass("invalid");
    } else {
      isValid = false;
      repairDate.addClass("invalid");
      errors.push("Please select a repair date");
    }

    const description = $("#description");
    const descriptionVal = description.val().trim();
    if (descriptionVal) {
      description.removeClass("invalid");
    } else {
      isValid = false;
      errors.push("Please enter a repair description");
      description.addClass("invalid");
    }

    const repairCostInput = $("#repairCost");
    const repairCost = repairCostInput.val().trim();
    const repairCostCurrency = $("#repairCostCurrency");
    if (repairCost) {
      if (isNaN(repairCost)) {
        repairCostInput.addClass("invalid");
        isValid = false;
        errors.push("If a repair cost is entered it must be a number.");
      } else {
        repairCostInput.removeClass("invalid");
      }
      if (!repairCostCurrency.val()) {
        repairCostCurrency.addClass("invalid");
        isValid = false;
        errors.push("Please select a currency");
      } else {
        repairCostCurrency.removeClass("invalid");
      }
    } else {
      repairCostInput.removeClass("invalid");
      repairCostCurrency.removeClass("invalid");
    }

    //Make sure any notes contain text
    let notesValid = true;
    $(".standard-form-element.note").each(function() {
      const textArea = $("textarea", $(this));
      if (textArea.val().trim()) {
        textArea.removeClass("invalid");
      } else {
        textArea.addClass("invalid");
        isValid = false;
        notesValid = false;
      }
    });
    if (!notesValid) {
      errors.push("Please enter text for all notes");
    }

    if (!isValid) {
      const title = "There are errors!";
      let message = errors.join("<br>");
      showMessage(title, message);
    }
    return isValid;
  }

  function addNote(note) {
    //Create a clone of the note template
    const newNote = noteTemplate.clone();
    $("i", newNote).addClass("standard-tooltip").on("click.deleteNote", e => {
      Repairs.processDeleteNote(e.target);
    });
    if (note) {
      newNote.attr('id', `${note.note_id}`);
      const textarea = $('textarea', newNote);
      textarea.val(note.note_text);
    }
    $("#repairNotesWrapper").append(newNote);
    initializeStandardTooltip();
  }

  function processDeleteNote(target) {
    const title = "Are you sure?";
    const message = "Do you really want to delete this note?";
    showVerificationMessage(title, message).then(result => {
      if (result) {
        $(target).closest(".standard-form-element.note").remove();
      }
    });
  }

  function processDeleteRepair(repairID) {
    const title = 'Are you sure?';
    const message = 'Do you really want to delete this repair?';
    showVerificationMessage(title, message).then(result => {
      if (result) {
        deleteRepair(repairID);
      }
    });
  }

  function deleteRepair(repairID) {
    $.ajax({
      url: 'index.php',
      data: {
        module: 'repair',
        action: 'delete_repair',
        repair_id: repairID
      },
      beforeSend: function() {
        showWorking();
      }
    }).done(result => {
      result = JSON.parse(result);
      if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
        if (parseInt(result.data, 10) === parseInt(repairID, 10)) {
          table.row(`#${repairID}`).remove().draw();
          const message = "Repair was successfully deleted!";
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
        console.error(`Error deleting repair: ${result}`);
        const title = 'Error!';
        const message = 'An error has occurred. The repair could not be deleted.';
        showMessage(title, message);
      }
    }).fail((xhr, text, error) => {
      console.error(`Error deleting repair: ${error}`);
      const title = 'Error!';
      const message = 'An error has occurred. The repair could not be deleted.';
      showMessage(title, message);
    }).always(() => {
      hideWorking();
    });
  }
  /************************  end Functions  *********************/

  /************************  Exports  ***************************/
  _this.init = init;
  _this.processEditRepair = processEditRepair;
  _this.processSaveRepair = processSaveRepair;
  _this.addNote = addNote;
  _this.processDeleteNote = processDeleteNote;
  _this.hideForm = hideForm;
  _this.processAddRepair = processAddRepair;
  _this.processDeleteRepair = processDeleteRepair;
  /************************  end Exports  ***********************/
  return _this;
})();
