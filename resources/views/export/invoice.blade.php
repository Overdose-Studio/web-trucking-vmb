<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table style="border-collapse: collapse">
        {{-- HEADER --}}
        <tr>
            <td style="font-weight: bold" colspan="3">Nomor Tagihan :</td>
            <td colspan="2" style="text-align: right">{{ $bill->name }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" rowspan="3" style="text-align: right">{{ $bill->address }}</td>
        </tr>
        <tr>
            <td colspan="3">{{ $bill->number }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td style="font-weight: bold" colspan="3">ORDER NO : </td>
            <td colspan="2" style="text-align: right">{{ $bill->person_in_charge }}</td>
        </tr>
        <tr style="border: 1px solid">
            <td style="text-align: center; font-weight: bold; border-right: 1px solid">NO</td>
            <td style="text-align: center; font-weight: bold;" colspan="3">URAIAN</td>
            <td style="text-align: center; font-weight: bold; border-left: 1px solid">JUMLAH</td>
        </tr>
        <tr style="border-left: 1px solid; border-right: 1px solid"></tr>
        <tr style="border-left: 1px solid; border-right: 1px solid">
            <td></td>
            <td>Trucking Cost {{ $bill->name }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr style="border-left: 1px solid; border-right: 1px solid"></tr>

        {{-- CONTENT --}}
        @php
            $counter = 1;
        @endphp
        @foreach ($shipments as $shipment)
            <tr style="border-left: 1px solid; border-right: 1px solid">
                <td></td>
                <td>Tanggal : {{ $shipment->date }}</td>
            </tr>
            @foreach ($shipment->dailyTruckingActually as $dta)
                <tr style="border-left: 1px solid; border-right: 1px solid">
                    <td>{{ $counter }}</td>
                    <td colspan="3">
                        {{ $dta->destination1 != null ? $dta->destination1->detail : 'null' }}/{{ $dta->destination2 != null ? $dta->destination2->detail : 'null' }}/{{ $dta->destination3 != null ? $dta->destination3->detail : 'null' }}
                    </td>
                    <td>{{ $dta->price }}</td>
                </tr>
                <tr style="border-left: 1px solid; border-right: 1px solid">
                    <td></td>
                    <td>{{ $dta->size }}"</td>
                </tr>
                @php
                    $counter = $counter + 1;
                @endphp
            @endforeach
            <tr style="border-left: 1px solid; border-right: 1px solid"></tr>
        @endforeach
        <tr style="border-left: 1px solid; border-right: 1px solid; border-bottom: 1px solid"></tr>
    </table>
</body>

</html>
