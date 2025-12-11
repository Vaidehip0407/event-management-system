<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Event Calendar</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        #calendar {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <h1>Admin - Event Calendar</h1>
    <button id="addEventBtn">Add Event</button>
    <div id="calendar"></div>

    <!-- Event Modal -->
    <div id="eventModal" style="display:none;">
        <h2 id="modalTitle">Add Event</h2>
        <input type="hidden" id="event_id">
        <label>Event Name:</label> <input type="text" id="event_name"><br>
        <label>Date:</label> <input type="date" id="event_date"><br>
        <label>Time:</label> <input type="time" id="event_time"><br>
        <label>Description:</label> <input type="text" id="event_description"><br>
        <label>Location:</label> <input type="text" id="event_location"><br>
        <button id="saveEventBtn">Save</button>
        <button id="deleteEventBtn" style="display:none;">Delete</button>
        <button onclick="$('#eventModal').hide();">Cancel</button>
    </div>

    <script>
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: 'admin_fetch_events.php',
                editable: true,
                eventClick: function (info) {
                    $('#event_id').val(info.event.id);
                    $('#event_name').val(info.event.title);
                    $('#event_date').val(info.event.start.toISOString().slice(0, 10));
                    $('#event_time').val(info.event.start.toISOString().slice(11, 16));
                    $('#event_description').val(info.event.extendedProps.description);
                    $('#event_location').val(info.event.extendedProps.location);
                    $('#modalTitle').text("Edit Event");
                    $('#deleteEventBtn').show();
                    $('#eventModal').show();
                }
            });

            calendar.render();

            $('#addEventBtn').click(function () {
                $('#modalTitle').text("Add Event");
                $('#event_id').val('');
                $('#event_name, #event_date, #event_time, #event_description, #event_location').val('');
                $('#deleteEventBtn').hide();
                $('#eventModal').show();
            });

            $('#saveEventBtn').click(function () {
                var data = {
                    event_id: $('#event_id').val(),
                    event_name: $('#event_name').val(),
                    event_date: $('#event_date').val(),
                    event_time: $('#event_time').val(),
                    event_description: $('#event_description').val(),
                    event_location: $('#event_location').val(),
                    action: $('#event_id').val() ? "edit" : "add"
                };

                $.post("admin_manage_events.php", data, function (response) {
                    alert(response);
                    $('#eventModal').hide();
                    location.reload();
                });
            });

            $('#deleteEventBtn').click(function () {
                var data = {
                    event_id: $('#event_id').val(),
                    action: "delete"
                };

                if (confirm("Are you sure you want to delete this event?")) {
                    $.post("admin_manage_events.php", data, function (response) {
                        alert(response);
                        $('#eventModal').hide();
                        location.reload();
                    });
                }
            });
        });
    </script>

</body>

</html>
