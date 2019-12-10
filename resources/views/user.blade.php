<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Mitra</th>
        </tr>
    </thead> 
    <tbody>
        @foreach($user as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>
                @foreach ($p->company as $i)
                {{ $i->name }},
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>