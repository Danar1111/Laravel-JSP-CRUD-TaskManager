<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Task Recap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        p {
            font-size: 18px;
            color: #555555;
            margin-bottom: 15px;
        }

        ul {
            list-style-type: decimal;
            padding: 0;
        }

        li {
            font-size: 16px;
            color: #333333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Task Recap</h2>
        <p>Hello, {{ $user->name }}!</p>
        <p>Here is a recap of your assignments: </p>
        <br>
        <ul>
            @foreach ($tasks as $task)
            <li>{{ $task->title }} - Due: {{ $task->due_date }}</li>
            @endforeach
        </ul>
        <br>
        <p>We hope this information helps you manage your tasks.</p>
        <div class="footer">
            <p>If you have any questions, feel free to contact us at priyambodo02@gmail.com.</p>
            <p>Thank you for using Task Manager!</p>
        </div>
    </div>
</body>

</html>
