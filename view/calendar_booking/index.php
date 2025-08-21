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
        <!-- <h5 class="mb-3">Booking Form</h5>
        <form action="#" class="d-flex flex-wrap gap-2 mb-4">
          <input type="date" class="form-control flex-grow-1" />
          <button class="btn btn-primary" type="submit">Book</button>
        </form> -->

        <!-- Responsive Calendar -->
        <div class="table-responsive">
          <div id="calendar"></div>
        </div>
      </div>
    </div>

  </body>
