Parts = (function() {
  const _this = {};
  /***********************  Variables  ***************************/
  let vehicle;
  let repair;
  let part;
  const dateTimePickerOptions = {
    altField: '#purchaseDateHidden',
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
    order: [[6, 'desc']],
    columnDefs: [
      {width: "35%", targets: 0},
      {width: "10%", targets: 1},
      {width: "10%", targets: 2},
      {width: "10%", targets: 3},
      {width: "10%", targets: 4},
      {width: "5%", targets: 5},
      {width: "10%", targets: 6},
      {width: "10%", targets: 7},
      {orderable: false, sortable: false, targets: 7}
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
        data: "part_number",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "source",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "brand",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "part_cost",
        className: "text-center",
        render: function(data, type, row) {
          if (type === 'display') {
            let content = "";
            if (data) {
              if (currencyData[row.part_cost_currency].currency_symbol_position === '1') {//Before value
                content = `${currencyData[row.part_cost_currency].html_entity}${data}`;
              } else {//After value
                content = `${data} ${currencyData[row.part_cost_currency].html_entity}`;
              }
            }
            return content;
          } else {
            return data;
          }
        }
      },
      {
        data: "qty",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "purchase_date",
        className: "text-center",
        render: function(data, type) {
          if (type === "display") {
            let content = "";
            if (data) {
              content =  moment(data).format("DD MMM YYYY");
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
          return `<div class='table-function-icons-wrapper'>
                    <i class="fas fa-edit fa-fw standard-tooltip" title='Edit part' onclick='Parts.processEditPart(${row.part_id});'></i>
                    <i class="fas fa-trash-alt fa-fw standard-tooltip" title='Delete part' onclick='Parts.processDeletePart(${row.part_id});'></i>
                  </div>`;
        }
      }
    ],
    createdRow: function(row, data) {
      $(row).attr('id', `${data.part_id}`);
    },
    drawCallback: function() {
      initializeStandardTooltip();
    }
  };
  /***********************  end Variables  ***********************/
  
  /***********************  Functions  ***************************/
  async function init(args) {
    currencyData = await Session.getItem("currencyData");
    populateCurrencySelect();
    vehicle = args.vehicle;
    repair = args.repair;
    tableOptions.data = args.parts;
    table = $("#partsTable").DataTable(tableOptions);
    $("#purchaseDate").datepicker(dateTimePickerOptions);
    evaluateBackButton();
    //Create template for notes
    const noteTemplateElement = $('div.note.new');
    noteTemplate = noteTemplateElement.first().clone();
    noteTemplateElement.remove();
    noteTemplate.removeClass('new');
    initializeStandardTooltip();
  }

  function populateCurrencySelect() {
    const select = $("#partCostCurrency");
    for (const currencySymbolID in currencyData) {
      select.append(new Option(
        currencyData[currencySymbolID].currency_symbol,
        currencySymbolID
        )
        );
    }
  }
  
  function processEditPart(partID) {
    if (part) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (result) {
          clearForm();
          editPart(partID);
        }
      });
    } else {
      editPart(partID);
    }
  }

  function editPart(partID) {
    part = table.row(`#${partID}`).data();
    setPageTitle(`Edit Part`);
    fillForm(part);
    showForm();
  }

  function fillForm() {
    $('#description').val(part.description);
    $('#partNumber').val(part.part_number ? part.part_number : '');
    $('#source').val(part.source ? part.source : '');
    $('#brand').val(part.brand ? part.brand : '');
    if (part.part_cost) {
      $('#partCost').val(part.part_cost);
      $("#partCostCurrency").val(part.part_cost_currency);
    }
    $('#qty').val(part.qty ? part.qty : '');
    if (part.purchase_date) {
      $("#purchaseDate").datepicker('setDate', moment(part.purchase_date).format("DD MMM YYYY")).trigger("change");
    }
    if (part.notes && part.notes.length) {
      for (const note of part.notes) {
        addNote(note);
      }
    }
  }
  
  function processAddPart() {
    let proceed = true;
    if (part) {
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
      setPageTitle('Add New Part');
    }
  }

  function showForm() {
    $('#formPartWrapper').slideDown(600, () => {
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
    $('#formPartWrapper').slideUp(600, () => {
      setPageTitle(`${vehicle.name} - Repair Parts`);
      clearForm();
    });
  }

  function clearForm() {
    part = null;
    $('#partID').val('');
    $('#description').val('');
    $('#partNumber').val('');
    $('#source').val('');
    $('#brand').val('');
    $('#partCost').val('');
    $('#partCostCurrency').val('');
    $('#qty').val('');
    $("#purchaseDate").datepicker('setDate', null);
    $("#purchaseDateHidden").val('');
    $("#partNotesWrapper").empty();
  }
  
  async function processSavePart() {
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
      $('#repairID').val(repair.repair_id);
      if (part) {
        $('#partID').val(part.part_id);
      }
      const partFormData = new FormData(partForm);
      $.ajax({
        url: 'index.php?module=part&action=set_part',
        processData: false,
        contentType: false,
        type: 'post',
        data: partFormData,
        beforeSend: function() {
          showWorking();
        }
      }).done(result => {
        result = JSON.parse(result);
        if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
          const partData = result.data;
          table.row(`#${partData.part_id}`).remove();
          table.row.add(partData).draw();
          const message = part ? "Part information was successfully updated!" : "The part was successfully created!";
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
          console.error(`Error setting part: ${result}`);
          const title = 'Error!';
          const message = 'An error has occurred. The part data could not be successfully saved.';
          showMessage(title, message);
        }
      }).fail((xhr, text, error) => {
        console.error(`Error setting part: ${error}`);
        const title = 'Error!';
        const message = 'An error has occurred. The part data could not be successfully saved.';
        showMessage(title, message);
      }).always(() => {
        hideWorking();
      });
    }
  }

  function validateForm() {
    errors.length = 0;
    let isValid = true;

    const description = $("#description");
    const descriptionVal = description.val().trim();
    if (descriptionVal) {
      description.removeClass("invalid");
    } else {
      isValid = false;
      errors.push("Please enter a part description");
      description.addClass("invalid");
    }
    
    const qty = $('#qty');
    if (qty.val()) {
      qty.removeClass("invalid");
    } else {
      isValid = false;
      errors.push("Please enter a quantity");
      qty.addClass("invalid");
    }
    
    const partCostInput = $("#partCost");
    const partCost = partCostInput.val().trim();
    const partCostCurrency = $("#partCostCurrency");
    if (partCost) {
      if (isNaN(partCost)) {
        partCostInput.addClass("invalid");
        isValid = false;
        errors.push("If a part price is entered it must be a number.");
      } else {
        partCostInput.removeClass("invalid");
      }
      if (!partCostCurrency.val()) {
        partCostCurrency.addClass("invalid");
        isValid = false;
        errors.push("Please select a currency");
      } else {
        partCostCurrency.removeClass("invalid");
      }
    } else {
      partCostInput.removeClass("invalid");
      partCostCurrency.removeClass("invalid");
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
      Parts.processDeleteNote(e.target);
    });
    if (note) {
      newNote.attr('id', `${note.note_id}`);
      const textarea = $('textarea', newNote);
      textarea.val(note.note_text);
    }
    $("#partNotesWrapper").append(newNote);
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

  function processDeletePart(partID) {
    const title = 'Are you sure?';
    const message = 'Do you really want to delete this part?';
    showVerificationMessage(title, message).then(result => {
      if (result) {
        deletePart(partID);
      }
    });
  }

  function deletePart(partID) {
    $.ajax({
      url: 'index.php',
      data: {
        module: 'part',
        action: 'delete_part',
        part_id: partID
      },
      beforeSend: function() {
        showWorking();
      }
    }).done(result => {
      result = JSON.parse(result);
      if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
        if (parseInt(result.data, 10) === parseInt(partID, 10)) {
          table.row(`#${partID}`).remove().draw();
          const message = "Part was successfully deleted!";
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
        console.error(`Error deleting part: ${result}`);
        const title = 'Error!';
        const message = 'An error has occurred. The part could not be deleted.';
        showMessage(title, message);
      }
    }).fail((xhr, text, error) => {
      console.error(`Error deleting part: ${error}`);
      const title = 'Error!';
      const message = 'An error has occurred. The part could not be deleted.';
      showMessage(title, message);
    }).always(() => {
      hideWorking();
    });
  }
  /***********************  end Functions  ***********************/
  
  /***********************  Exports  *****************************/
  _this.init = init;
  _this.processEditPart = processEditPart;
  _this.processSavePart = processSavePart;
  _this.addNote = addNote;
  _this.processDeleteNote = processDeleteNote;
  _this.hideForm = hideForm;
  _this.processAddPart = processAddPart;
  _this.processDeletePart = processDeletePart;
  /***********************  end Exports  *************************/
  return _this;
})();