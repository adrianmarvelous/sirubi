<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.css" rel="stylesheet" />

    <!-- FullCalendar & Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js"></script>

    <script>
      const bookedDates = <?= json_encode($bookedDates) ?>;
      document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');

      // Convert booked dates to FullCalendar event format
      const bookedEvents = bookedDates.map(date => ({
        start: date,
        display: 'background',
        backgroundColor: 'red'
      }));

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,

        events: bookedEvents, // 🔴 Highlight booked dates

        dateClick: function (info) {
          if (bookedDates.includes(info.dateStr)) {
            // 🔴 Jika tanggal sudah dibooking, tampilkan modal unavailable
            var modal = new bootstrap.Modal(document.getElementById('unavailableModal'));
            modal.show();
          } else {
            // ✅ Jika tersedia, buka modal booking
            document.getElementById('selected-date').textContent = info.dateStr;
            document.getElementById('selected-date-input').value = info.dateStr;
            var modal = new bootstrap.Modal(document.getElementById('dateModal'));
            modal.show();
          }
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
          <form action="controller/booking.php" method="post">
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
    <!-- Modal Tanggal Tidak Tersedia -->
    <div class="modal fade" id="unavailableModal" tabindex="-1" aria-labelledby="unavailableModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-danger text-white rounded-top">
            <h5 class="modal-title text-white" id="unavailableModalLabel">Tanggal Tidak Tersedia</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Maaf, tanggal ini sudah dibooking. Silakan pilih tanggal lain.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>


  </body
