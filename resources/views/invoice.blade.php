<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <style>
        body {
    font-family: Arial, sans-serif;
}

.container {
    width: 700px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.details {
    margin-bottom: 10px;
}

.total {
    font-weight: bold;
    text-align: right;
    margin-top: 20px;
}

.footer {
    margin-top: 20px;
    text-align: center;
    font-style: italic;
    font-size: 12px;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>BUKTI PEMBAYARAN SPP</h2>
        </div>
        ===========================================================================
        <div class="details">
            <p>Nama Siswa          : {{ $invoice->nama }}</p>
            <p>Tanggal Pembayaran  : {{ $invoice->tgl_bayar }}</p>
            <p>Jumlah              : Rp. {{ $invoice->jumlah }}</p>
        </div>
        ===========================================================================
        <div class="total">
            <p>Total: Rp. {{ $invoice->jumlah }}</p>
        </div>
        <div class="footer">
            <p>--------------------------------------------------------------------</p>
            <p>Terima kasih atas pembayaran Anda</p>
        </div>
    </div>
</body>
</html>
