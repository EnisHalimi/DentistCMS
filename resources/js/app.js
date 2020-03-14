require('./components/jquery.min')
require('./bootstrap')
require('./components/sb-admin-2')
require('./components/jquery.easing.min')
require('./components/datatables.min')
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import sqLocale from '@fullcalendar/core/locales/sq';
if(window.location.href.indexOf("calendar") > -1 || window.location.pathname == '/' ) {
  
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();
  var calendar = new Calendar(calendarEl, {
    plugins: [ dayGridPlugin ],
    locale: sqLocale,
    header: {
      left: 'prev,next,today',
      center: 'title',
      right: 'dayGridMonth,dayGridWeek,dayGridDay'
    },
    buttonText: {
      today:    'Sot',
      month:    'Muaji',
      week:     'Java',
      day:      'Dita',
      list:     'Lista'
    }, 
    themeSystem: 'jquery-ui',
    eventTextColor: 'white',
    defaultDate: yyyy+'-'+mm+'-'+dd,
    navLinks: true,
    eventLimit: true, 
    events: '/getAppointments'

  });
  calendar.render();
});
  console.log('executed');
}

function jQuery() 
{
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });

    $(document).on('click', '.dropdown-menu', function(e) {
      if ($(this).hasClass('keep-open-on-click')) { e.stopPropagation(); }
  });

  
  $(document).ready(function(){

    $('#searchPacient').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/searchPacient",
        "columns": [
          {"data":"first_name"},
          {"data":"last_name"},
          {"data":"personal_number"},
          {"data": "Shto", "bSearchable": false}
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      });

    $('#searchUser').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/searchUser",
        "columns": [
          {"data":"name"},
          {"data":"email"},
          {"data": "Shto", "bSearchable": false }
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      }
    );


      $('#searchService').DataTable(
        {
          "processing": true,
          "serverSide": true,
          "ajax":"/searchService",
          "columns": [
            {"data":"name"},
            {"data":"price"},
            {"data":"discount"},
            {"data": "Shto", "bSearchable": false }
          ],
          "language": {
            "lengthMenu": "Shfaq _MENU_ për faqe",
            "zeroRecords": "Nuk u gjet asnjë e dhënë",
            "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
            "infoEmpty": "Nuk ka të dhëna",
            "infoFiltered": "(Të filtruar nga _MAX_ total)",
            "processing":     "Duke procesuar...",
            "search":         "",
            "paginate": {
              "first":      "Fillimi",
              "last":       "Fundi",
              "next":       "Para",
              "previous":   "Prapa"}
            }
        }
      );


      $('#searchTreatment').DataTable(
        {
          "processing": true,
          "serverSide": true,
          "ajax":"/searchTreatment",
          "columns": [
            {"data":"pacient_id"},
            {"data":"starting_date"},
            {"data":"duration"},
            {"data": "Shto", "bSearchable": false }
          ],
          "language": {
            "lengthMenu": "Shfaq _MENU_ për faqe",
            "zeroRecords": "Nuk u gjet asnjë e dhënë",
            "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
            "infoEmpty":"Nuk ka të dhëna",
            "infoFiltered": "(Të filtruar nga _MAX_ total)",
            "processing":     "Duke procesuar...",
            "search":         "",
            "paginate": {
              "first":      "Fillimi",
              "last":       "Fundi",
              "next":       "Para",
              "previous":   "Prapa"}
            }
        }
      );



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
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
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
          {"data":"role"},
          {"data":"color"},
          {"data": "Menaxhimi", "bSearchable": false }
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
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
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
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
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
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
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty":"Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
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
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      }
    );

    $('#ReportdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/reportDatatable",
        "columns": [
          {"data":"pacient_id"},
          {"data":"user_id"},
          {"data":"created_at"},
          {"data": "Menaxhimi", "bSearchable": false }
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      }
    );

    $('#NotificationsdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/notificationsDatatable",
        "columns": [
          {"data":"description",'bSortable': false},
          {"data":"created_at", 'bSortable': false},
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      }
    );

    $('#DebtdataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/debtDatatable",
        "columns": [
          {"data":"pacient"},
          {"data":"deadline"},
          {"data":"value"},
          {"data": "Menaxhimi", "bSearchable": false }
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      }
    );

    $('#RoledataTable').DataTable(
      {
        "processing": true,
        "serverSide": true,
        "ajax":"/roleDatatable",
        "columns": [
          {"data":"name"},
          {"data":"number"},
          {"data":"access"},
          {"data": "Menaxhimi", "bSearchable": false }
        ],
        "language": {
          "lengthMenu": "Shfaq _MENU_ për faqe",
          "zeroRecords": "Nuk u gjet asnjë e dhënë",
          "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
          "infoEmpty": "Nuk ka të dhëna",
          "infoFiltered": "(Të filtruar nga _MAX_ total)",
          "processing":     "Duke procesuar...",
          "search":         "Kërko:",
          "paginate": {
            "first":      "Fillimi",
            "last":       "Fundi",
            "next":       "Para",
            "previous":   "Prapa"}
          }
      });

      $('#BilldataTable').DataTable(
        {
          "processing": true,
          "serverSide": true,
          "ajax":"/billDatatable",
          "columns": [
            {"data":"subject"},
            {"data":"bill_nr"},
            {"data":"deadline"},
            {"data":"value"},
            {"data": "Menaxhimi", "bSearchable": false }
          ],
          "language": {
            "lengthMenu": "Shfaq _MENU_ për faqe",
            "zeroRecords": "Nuk u gjet asnjë e dhënë",
            "info": "Duke shfaqur faqen _PAGE_ nga _PAGES_",
            "infoEmpty": "Nuk ka të dhëna",
            "infoFiltered": "(Të filtruar nga _MAX_ total)",
            "processing":     "Duke procesuar...",
            "search":         "Kërko:",
            "paginate": {
              "first":      "Fillimi",
              "last":       "Fundi",
              "next":       "Para",
              "previous":   "Prapa"}
            }
        }
      );

  });
}
  jQuery();

  

