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
                        <th>Nama Pengguna</th>
                        <th>Hadiah</th>
                        <th width="1%">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $a)
                    <tr>
                        <td>{{ $a->nama }}</td>
                        <td>
                            <ul>
                                @foreach($a->hadiah as $h)
                                <li> {{ $h->nama_hadiah }} </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">{{ $a->hadiah->count() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</body>
</html>