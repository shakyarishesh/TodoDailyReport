<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/moment/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    @include('header')
    <div class="container">
        <h1>User Profile</h1>
        <h2>Report History</h2>
        <table>
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Description</th>
                    <th>Challenges</th>
                    <th>To Do</th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="text" name="date_range" id="date_range"
                            class="form-control form-control-sm date-input"
                            value="{{ request('start_date') ? request('start_date') . ' - ' . request('end_date') : '' }}">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->date }}</td>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->time_from }}</td>
                        <td>{{ $report->time_to }}</td>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->challenges }}</td>
                        <td>{{ $report->todo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {
        function initDateRangePicker(elementId) {
            $(elementId).daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                locale: {
                    cancelLabel: 'Clear',
                    format: 'YYYY-MM-DD'
                }
            });

            $(elementId).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
                filterTableByDateRange(picker.startDate, picker.endDate);
            });

            $(elementId).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                resetTableFilter();
            });
        }

        function filterTableByDateRange(startDate, endDate) {
            const tableBody = $('#userTableBody');
            const rows = tableBody.find('tr');

            rows.each(function() {
                const issuedDateCell = $(this).find('td').eq(
                1); // Adjusted index to match "Date" column
                if (issuedDateCell.length) {
                    const issuedDate = moment(issuedDateCell.text().trim());
                    if (issuedDate.isBetween(startDate, endDate, null, '[]')) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }

        function resetTableFilter() {
            $('#userTableBody tr').show();
        }

        initDateRangePicker('#date_range');
    });
</script>

</html>
