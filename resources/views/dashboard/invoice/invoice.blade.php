<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
    <style>
        .ttd td,
        .ttd th {
            padding-bottom: 4em;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:1000px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <span style='font-size:12pt'><b>Nama Toko</b></span></br>
                Alamat Toko Alamat Toko Alamat Toko Alamat Toko Alamat Toko Alamat Toko Alamat Toko Alamat Toko Alamat
                Toko Alamat Toko </br>
                Telp : 0594094545
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>FAKTUR PENJUALAN</span></b></br>
                No Invoice. : {{ $transaction->kode_inv }}</br>
                Tanggal : {{ $transaction->created_at->isoFormat('dddd, D MMMM Y') }}</br>
                 {{ $transaction->status }}</br>
                Jatuh Tempo : {{ $transaction->jatuh_tempo }}</br>
            </td>
        </table>
        <table style='width:1000px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Kepada Yth. : {{ $transaction->nama_pelanggan }}</br>
                Alamat : {{ $pelanggan->alamat }} <br>
                No Telp :{{ $pelanggan->no_tlp }}
            </td>
           
        </table>
        <table cellspacing='0' style='width:1000px; font-size:8pt; font-family:calibri;  border-collapse: collapse;'
            border='1'>
            <tbody>
                <tr align='center'>
                    <td width='20%'>Nama Barang</td>
                    <td width='13%'>Qty</td>
                    <td width='4%'>Harga</td>
                    <td width='7%'>Disc (%)</td>
                    <td width='7%'>Disc (Rp)</td>
                    <td width='7%'>Subtotal</td>
                    @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->nama_barang }}</td>
                    <td>{{ $order->qty }}</td>
                    <td>{{ $order->harga_Jual }}</td>
                    <td>{{ $order->disc_perc }}</td>
                    <td>{{ $order->disc_rp }}</td>
                    <td>@currency($order->subtotal)</td>
                </tr>
                @endforeach

                <tr>
                    <td colspan = '5'>
                        <div style='text-align:right'>Total Yang Harus Di Bayar Adalah : </div>
                    </td>
                    <td style='text-align:right'>@currency($transaction->total)</td>
                </tr>
                <tr>
                    <td colspan = '5'>
                        <div style='text-align:right'>Terbilang : </div>
                    </td>
                    <td style='text-align:right'>{{ Terbilang::make($transaction->total) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Keterangan</td>
                    <td>{{ $transaction->keterangan }}</td>
                </tr>
                <tr class="ttd">
                    <th colspan="3">Penerima</th>

                    <th colspan="3">Hormat Kami</th>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">{{ $transaction->nama_pelanggan }}</td>

                    <td colspan="3" style="text-align: center;">{{ $transaction->nama_petugas }}</td>
                </tr>
            </tfoot>
        </table>

</body>

</html>
<script>
   window.onload = function() { window.print(); }
</script>