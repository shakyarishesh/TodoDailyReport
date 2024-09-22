<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('images/sunset.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            height: 150vh;
            margin-top: 0;
            padding: 200px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.363);
            /* Semi-transparent white background */
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 5em;
        }


        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
        }

        .action-btn {
            background-color: #007bff;
            color: #fff;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <section>
        @include('header')
        <div class="container">
            <h2>Task List</h2>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Todo</td>
                        @if (session()->has('login'))
                            <td><a href="/todo" class="action-btn">View</a></td>
                        @endif
                        @if (session()->has('login') == null)
                            <td><a href="/" class="action-btn">View</a></td>
                        @endif

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Daily Report</td>
                        @if (session()->has('login'))
                            <td><a href="/report" class="action-btn">View</a></td>
                        @endif
                        @if (session()->has('login') == null)
                            <td><a href="/" class="action-btn">View</a></td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
