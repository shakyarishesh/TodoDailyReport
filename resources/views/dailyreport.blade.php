<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report Form</title>
    <link rel="stylesheet" href="{{asset('css/report.css')}}">
</head>
<body>
    <div class="container">
        <h1>Daily Report</h1>
        <form action="/reportPost" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="timeFrom">Time From:</label>
                <input type="time" id="timeFrom" name="timeFrom" required>
            </div>

            <div class="form-group">
                <label for="timeTo">Time To:</label>
                <input type="time" id="timeTo" name="timeTo" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="challenges">Challenges:</label>
                <textarea id="challenges" name="challenges" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="todo">To Do:</label>
                <textarea id="todo" name="todo" rows="4"></textarea>
            </div>

            <input type="submit" value="Submit Report" />
        </form>
    </div>

 
</body>
</html>
