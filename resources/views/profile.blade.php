<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$loop->iteration}}</td>
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
</html>
