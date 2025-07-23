<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FullCalendar & Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          selectable: true,

          dateClick: function (info) {
            document.getElementById('selected-date').textContent = info.dateStr;
            document.getElementById('selected-date-input').value = info.dateStr;
            var modal = new bootstrap.Modal(document.getElementById('dateModal'));
            modal.show();
          }

        });
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div class="container py-4">
      <div class="card p-4 shadow-sm">
        <h5 class="mb-3">Booking Form</h5>
        <form action="#" class="d-flex flex-wrap gap-2 mb-4">
          <input type="date" class="form-control flex-grow-1" />
          <button class="btn btn-primary" type="submit">Book</button>
        </form>

        <!-- Responsive Calendar -->
        <div class="table-responsive">
          <div id="calendar"></div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Modal -->
     <!-- Sneat-style Modal -->
    <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header rounded-top">
            <h5 class="modal-title" id="dateModalLabel">Pilih Tanggal Booking</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="controller/calendar.php" method="post">
            <div class="modal-body">
              <div class="mb-3 text-muted">
                Tanggal yang dipilih: <strong id="selected-date" class="text-dark"></strong>
              </div>
            </div>
            <div class="modal-footer border-top-0">
              <input type="hidden" name="selected_date" id="selected-date-input">
              <input type="hidden" name="action" value="pilih_tanggal">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x me-1"></i> Batal
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="bx bx-check me-1"></i> Konfirmasi Booking
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </body
