<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacts (People)</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .title {
            font-family: 'Courier New', monospace;
            /* Use a monospaced font */
            font-size: 2em;
            /* Adjust the font size as needed */
            font-weight: bold;
            letter-spacing: 2px;
            /* Adjust letter spacing as needed */
            color: #29b6f6;
            /* Set the desired text color */
            text-transform: uppercase;
            /* Convert text to uppercase */
            margin-bottom: 20px;
            /* Adjust spacing as needed */
        }

        .name {
            font-weight: bold;
        }

        /* Apply background colors to even and odd rows */
        tr:nth-child(even) {
            background-color: #effa59;
            /* Set the background color for even rows */
        }

        tr:nth-child(odd) {
            /* background-color: #eef5af; */
            /* Set the background color for odd rows */
        }


        td {
            padding-top: 6px;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <td>
                <img src="{{ public_path('images/contact-icon.png') }}" alt="contact" width="100" />
            </td>
            <td>
                <h2 class="title">{{ $user->name }}'s contacts</h2>
            </td>
        </tr>
    </table>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Business</th>
                    <th>BirthDay</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $person)
                    <tr>
                        <td class="name">
                            {{ $person->firstname }} {{ $person->lastname }}
                        </td>
                        <td>{{ $person->email }}</td>
                        <td>{{ $person->phone }}</td>
                        <td>{{ $person->business?->business_name }}</td>
                        <td>{{ $person->birthday }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
