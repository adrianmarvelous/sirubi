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
  const bookedEvents = <?= json_encode($bookedEvents) ?>;

  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      selectable: true,

      events: bookedEvents, // ✅ events now include instansi names

      dateClick: function (info) {
        // Check if clicked date has event
        const eventOnDate = bookedEvents.find(e => e.start === info.dateStr);
        if (eventOnDate) {
          alert("Tanggal sudah dibooking oleh: " + eventOnDate.title);
        } else {
          alert("Tanggal tersedia: " + info.dateStr);
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
