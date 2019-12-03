
function filterUserFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("search-user");
    filter = input.value.toUpperCase();
    div = document.getElementById("dropdown-user");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }
  
  function filterPacientFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("search-pacient");
    filter = input.value.toUpperCase();
    div = document.getElementById("dropdown-pacient");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }
  function DataTables() {
    $('#PacientdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/pacientDatatable",
        "columns": [
          {"data":"first_name"},
          {"data":"last_name"},
          {"data":"personal_number"},
          {"data":"date_of_birth"},
          {"data":"address"},
          {"data":"residence"},
          {"data": "Menaxhimi", "bSearchable": false}
        ]
      });
    $('#UserdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/userDatatable",
        "columns": [
          {"data":"name"},
          {"data":"email"},
          {"data":"password"},
          {"data":"position"},
          {"data": "Menaxhimi", "bSearchable": false }
        ]
      }
    );
    $('#AppointmentdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/appointmentDatatable",
        "columns": [
          {"data":"pacient_id"},
          {"data":"user_id"},
          {"data":"date_of_appointment"},
          {"data":"time_of_appointment"},
          {"data": "Menaxhimi", "bSearchable": false }
        ]
      }
    );
    $('#VisitdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/visitDatatable",
        "columns": [
          {"data":"pacient_id"},
          {"data":"user_id"},
          {"data":"date_of_visit"},
          {"data":"time_of_visit"},
          {"data": "Menaxhimi", "bSearchable": false }
        ]
      }
    );

    $('#TreatmentdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/treatmentDatatable",
        "columns": [
          {"data":"pacient_id"},
          {"data":"starting_date"},
          {"data":"duration"},
          {"data": "Menaxhimi", "bSearchable": false }
        ]
      }
    );

    $('#ServicedataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/serviceDatatable",
        "columns": [
          {"data":"name"},
          {"data":"price"},
          {"data":"discount"},
          {"data": "Menaxhimi", "bSearchable": false }
        ]
      }
    );

    $('#NotificationsdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/notificationsDatatable",
        "columns": [
          {"data":"description"},
          {"data":"created_at"},
        ]
      }
    );

  }

DataTables();