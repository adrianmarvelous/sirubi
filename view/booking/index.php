<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- FullCalendar CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS (required for modal) -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- FullCalendar & Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      const bookedDates = <?= json_encode($bookedDates) ?>;

      document.addEventListener("DOMContentLoaded", function () {
        const calendarEl = document.getElementById("calendar");

        // Convert booked dates to FullCalendar event format
        const bookedEvents = bookedDates.map((date) => ({
          start: date,
          display: "background",
          backgroundColor: "red",
        }));

        const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: "dayGridMonth",
          selectable: true,

          events: bookedEvents, // 🔴 Highlight booked dates

          // 🔽 Warnai hari yang tidak bisa dipilih
          dayCellDidMount: function (arg) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const minDate = new Date(today);
            minDate.setDate(today.getDate() + 7);

            const cellDate = arg.date;

            // Sebelum hari ini → abu-abu
            if (cellDate < today) {
              arg.el.style.backgroundColor = "#e9ecef";
              arg.el.style.color = "#6c757d";
              arg.el.classList.add("fc-disabled-day");
            }

            // Dari hari ini sampai H+6 → abu-abu
            if (cellDate >= today && cellDate < minDate) {
              arg.el.style.backgroundColor = "#e9ecef";
              arg.el.style.color = "#6c757d";
              arg.el.classList.add("fc-disabled-day");
            }
          },

          dateClick: function (info) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const minDate = new Date(today);
            minDate.setDate(today.getDate() + 7);

            const clickedDate = new Date(info.dateStr);

            // Get modal element
            const modalEl = document.getElementById("unavailableModal");
            const modal = new bootstrap.Modal(modalEl);

            // ❌ Kalau tanggal < H+7, blokir
            if (clickedDate < minDate) {
              document.getElementById("unavailableModalLabel").textContent =
                "Tanggal Tidak Bisa Dipilih";
              document.querySelector("#unavailableModal .modal-body").textContent =
                "Tanggal minimal bisa dipilih H+7 dari hari ini.";
              modal.show();
              return;
            }

            // ❌ Kalau sudah dibooking
            if (bookedDates.includes(info.dateStr)) {
              document.getElementById("unavailableModalLabel").textContent =
                "Tanggal Tidak Tersedia";
              document.querySelector("#unavailableModal .modal-body").textContent =
                "Maaf, tanggal ini sudah dibooking. Silakan pilih tanggal lain.";
              modal.show();
              return;
            }

            // ✅ Kalau valid → buka modal booking
            document.getElementById("selected-date").textContent = info.dateStr;
            document.getElementById("selected-date-input").value = info.dateStr;
            var dateModal = new bootstrap.Modal(
              document.getElementById("dateModal")
            );
            dateModal.show();
          },
        });

        calendar.render();
      });
    </script>
  </head>
  <body>
    <div class="container py-4">
      <div class="card p-4 shadow-sm">
        <!-- Responsive Calendar -->
        <div class="table-responsive">
          <div id="calendar"></div>
        </div>
      </div>
    </div>

    <!-- Modal Pilih Tanggal -->
    <div
      class="modal fade"
      id="dateModal"
      tabindex="-1"
      aria-labelledby="dateModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header rounded-top">
            <h5 class="modal-title" id="dateModalLabel">
              Pilih Tanggal Booking
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form action="controller/booking.php" method="post">
            <div class="modal-body">
              <div class="mb-3 text-muted">
                Tanggal yang dipilih:
                <strong id="selected-date" class="text-dark"></strong>
              </div>
            </div>
            <div class="modal-footer border-top-0">
              <input
                type="hidden"
                name="selected_date"
                id="selected-date-input"
              />
              <input type="hidden" name="action" value="pilih_tanggal" />
              <button
                type="button"
                class="btn btn-label-secondary"
                data-bs-dismiss="modal"
              >
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

    <!-- Modal Tanggal Tidak Tersedia (Reusable) -->
    <div
      class="modal fade"
      id="unavailableModal"
      tabindex="-1"
      aria-labelledby="unavailableModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header bg-danger text-white rounded-top">
            <h5
              class="modal-title text-white"
              id="unavailableModalLabel"
            >
              Tanggal Tidak Tersedia
            </h5>
            <button
              type="button"
              class="btn-close btn-close-white"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <!-- Default text (akan diubah via JS) -->
            Maaf, tanggal ini sudah dibooking. Silakan pilih tanggal lain.
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-danger"
              data-bs-dismiss="modal"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
