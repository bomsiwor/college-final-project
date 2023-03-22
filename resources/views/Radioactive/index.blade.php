<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Judul</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>z</th>
                <th>n</th>
                <th>symbol</th>
                <th>waktu paruh (detik)</th>
                <th>decay</th>
                <th>magnetic dipole</th>
                <th>electric quadrupole</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response as $resp)
                <tr>
                    <td>{{ $resp['z'] }}</td>
                    <td>{{ $resp['n'] }}</td>
                    <td>{{ $resp['symbol'] }}</td>
                    <td>{{ $resp['half_life'] }}</td>
                    <td>{{ $resp['decay_1'] }}</td>
                    <td>{{ $resp['magnetic_dipole'] }}</td>
                    <td>{{ $resp['electric_quadrupole'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
