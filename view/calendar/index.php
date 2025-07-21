<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
        });
        calendar.render();
      });

    </script>
  </head>
  <body>
    <div class="card p-5 m-3">
      <div>
        <form action="" class="d-flex justify-content-between" style="width: 290px;">
            <input type="date" class="form-control" style="width: 200px;">
            <button class="btn btn-primary" type="submit">Book</button>
        </form>
      </div>
        <div id='calendar'></div>
    </div>
  </body>
</html>