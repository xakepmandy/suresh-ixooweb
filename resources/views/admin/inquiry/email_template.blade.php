<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Inquiry Received</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2a9d8f;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
        }

        .data-table td.label {
            font-weight: bold;
            width: 30%;
            color: #555;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #999;
            text-align: center;
        }

        a {
            color: #2a9d8f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Inquiry Received</h2>
        <table class="data-table">
            <tr>
                <td class="label">Name:</td>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td class="label">Email:</td>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td class="label">Phone:</td>
                <td>{{ $data['phone'] }}</td>
            </tr>
            <tr>
                <td class="label">Company:</td>
                <td>{{ $data['company'] }}</td>
            </tr>
            <tr>
                <td class="label">Inquiry:</td>
                <td>{{ $data['inquiry'] }}</td>
            </tr>
            <tr>
                <td class="label">Message:</td>
                <td>{!! nl2br(e($data['message'])) !!}</td>
            </tr>
            @if (!empty($data['file']))
            <tr>
                <td class="label">Attached File:</td>
                <td><a href="{{ asset('storage/contact_files/'.$data['file']) }}" target="_blank">Download File</a></td>
            </tr>
            @endif
        </table>

        <div class="footer">
            This message was generated automatically from your website contact form.
        </div>
    </div>
</body>
</html>
