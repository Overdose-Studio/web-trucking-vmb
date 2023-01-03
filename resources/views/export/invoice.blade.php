<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <tbody>
            {{-- HEADER --}}
            <tr>
                <td colspan="3">Nomor Tagihan :</td>
                <td colspan="2">{{ $bill->name }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2" rowspan="3">{{ $bill->address }}</td>
            </tr>
            <tr>
                <td colspan="3">{{ $bill->number }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">ORDER NO : </td>
                <td colspan="2">{{ $bill->person_in_charge }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold">NO</td>
                <td style="font-weight: bold" colspan="3" width="50">URAIAN</td>
                <td style="font-weight: bold">JUMLAH</td>
            </tr>
            <tr></tr>
            <tr>
                <td></td>
                <td>Trucking Cost {{ $bill->name }}</td>
            </tr>
            <tr></tr>

            {{-- CONTENT --}}
            @foreach ($shipments as $shipment)
                <tr>
                    <td></td>
                    <td>Tanggal : {{ $shipment->date }}</td>
                </tr>
                {{-- Loop shipment data --}}
                @foreach ($shipment as $dta)
                    <tr>
                        <td>DTA -> {{ $dta }}</td>
                        <td>{{ $loop->iteration }}</td>
                    </tr>
                    {{-- <tr>
                        <td>{{ $shipment->id }}</td>
                        <td rowspan="2">{{ $loop->iteration }}</td>
                        <td colspan="3">
                            {{ $dta->destination_1 != null ? $dta->destination_1->detail : 'null' }}/{{ $dta->destination_2 != null ? $dta->destination_2->detail : 'null' }}/{{ $dta->destination_3 != null ? $dta->destination_3->detail : 'null' }}
                        </td>
                        <td>{{ $dta->price }}</td>
                    <tr>
                        <td>{{ $shipment }}</td>
                        <td rowspan="2">{{ $loop->iteration }}</td>
                        <td colspan="3">
                            {{ $dta != null ? $dta->destination_1->detail : 'null' }}/{{ $dta != null ? $dta->destination_2->detail : 'null' }}/{{ $dta != null ? $dta->destination_3->detail : 'null' }}
                        </td>
                        <td>{{ $dta->price }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Keterangan : {{ $dta->description }}</td>
                    </tr> --}}
                @endforeach
                {{-- @foreach ($shipment as $dta)
                        <tr>
                        <td rowspan="2">{{ $loop->iteration }}</td>
                        <td>Tanggal : {{ $dta->created_at }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        {{ $dta->destination_1 != null ? $dta->destination_1->detail : 'null' }}/{{ $dta->destination_2 != null ? $dta->destination_2->detail : 'null' }}/{{ $dta->destination_3 != null ? $dta->destination_3->detail : 'null' }}
                    </td>
                    <td>{{ $dta->price }}</td>
            @endforeach --}}
                {{-- <tr></tr> --}}
            @endforeach
        </tbody>
    </table>
</body>

</html>
