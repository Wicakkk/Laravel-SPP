@extends('template.main') 
@section('konten') 

<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Pembayaran</h1>
  <p class="mb-4">Manajemen Spp | Inventory Spp</p>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">SPP SEKOLAH PRESTASI PRIMA
      <h6 class="m-0 font-weight-bold text-primary">
        {{-- @if(Auth::user()->level == 'petugas') --}}
        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahData">Tambah Data</button>
        {{-- @endif --}}
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-sm table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr style="text-align: center">
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Tanggal Pembayaran</th>
              <th>Jumlah</th>
              @if(Auth::user()->level == 'admin')
              <th>Aksi</th>
              @endif
            </tr>
          </thead>
          <tbody> @php $no = 1; @endphp @foreach ($pembayaran as $row) <tr style="text-align: center">
              <td width="5%">{{$no++}}</td>
              <td>{{$row->nama}}</td>
              <td>{{$row->tgl_bayar}}</td>
              <td>Rp. {{$row->jumlah}}</td>
              @if(Auth::user()->level == 'admin')
              <td class="row d-flex justify-content-center">
                <button class="btn btn-sm btn-primary btn-edit" data-target="#editModal{{$row->id}}" data-toggle="modal" data-nama="{{ $row->nama }}" data-tanggal="{{ $row->tgl_bayar }}" data-jumlah="{{ $row->jumlah }}">
                  <i class="fas fa-pen"></i>
                </button>
                <form action="{{ route('pembayaran.delete', $row->id) }}" method="POST" style="display: inline-block;"> 
                  @csrf @method('DELETE') <button class="btn btn-sm btn-danger" type="submit">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
                <a onclick="printTable({{$loop->index}})" class="btn btn-sm btn-secondary">
                  <i class="fas fa-print"></i>
                </a>
                <a href="{{ route('print.invoice', $row->id) }}" class="btn btn-sm btn-success">
                  <i class="fas fa-download"></i>
                </a>
              </td>
              @endif
            </tr> @endforeach </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('pembayaran/save')}}" method="POST"> @csrf <div class="form-group">
            <label for="nama">Nama Siswa</label>
            <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal Pembayaran</label>
            <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar">
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah">
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit --> @foreach ($pembayaran as $row) <div class="modal fade" id="editModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$row->id}}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel{{$row->id}}">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editForm{{$row->id}}" action="{{ route('pembayaran.update', ['id' => $row->id]) }}" method="POST"> @csrf @method('PUT') <div class="modal-body">
          <!-- Form untuk mengedit data -->
          <div class="form-group">
            <label for="edit_nama{{$row->id}}">Nama Siswa</label>
            <input type="text" class="form-control" id="edit_nama{{$row->id}}" name="nama" value="{{ $row->nama }}">
          </div>
          <div class="form-group">
            <label for="edit_tanggal{{$row->id}}">Tanggal Pembayaran</label>
            <input type="date" class="form-control" id="edit_tanggal{{$row->id}}" name="tgl_bayar" value="{{ $row->tgl_bayar }}">
          </div>
          <div class="form-group">
            <label for="edit_jumlah{{$row->id}}">Jumlah</label>
            <input type="number" class="form-control" id="edit_jumlah{{$row->id}}" name="jumlah" value="{{ $row->jumlah }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div> @endforeach @endsection @section('js') <script>
  @if($message = Session::get('dataTambah'))
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  Toast.fire({
    icon: 'success',
    title: 'Data Pembayaran Berhasil Ditambah'
  });
  @endif
  $(document).ready(function() {
    // Ketika tombol Edit ditekan
    $('.btn-edit').click(function() {
      // Mengambil data dari baris tabel terkait
      var nama = $(this).data('nama');
      var tanggal = $(this).data('tanggal');
      var jumlah = $(this).data('jumlah');
      // Mengisi nilai awal dalam form modal dengan data yang ingin diedit
      var modalId = $(this).closest('tr').find('.modal').attr('id');
      $('#' + modalId + ' #edit_nama').val(nama);
      $('#' + modalId + ' #edit_tanggal').val(tanggal);
      $('#' + modalId + ' #edit_jumlah').val(jumlah);
      // Menampilkan modal
      $('#' + modalId).modal('show');
    });
    $('.modal .btn-secondary').click(function() {
      $(this).closest('.modal').modal('hide');
    });
  });
</script>
<script>
  function printTable(rowIdx) {
    var row = document.querySelectorAll("#dataTable tbody tr")[rowIdx];
    if (row) {
        var nama = row.querySelector('td:nth-child(2)').innerText.trim();
        var tgl_bayar = row.querySelector('td:nth-child(3)').innerText.trim();
        var jumlah = row.querySelector('td:nth-child(4)').innerText.trim();
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><title>Laporan</title></head><body>');
        newWin.document.write('<h1>Laporan Pembayaran SPP</h1>');
        newWin.document.write('<p>Nama Siswa           : ' + nama + '</p>');
        newWin.document.write('<p>Tanggal Pembayaran   : ' + tgl_bayar + '</p>');
        newWin.document.write('<p>Jumlah Pembayaran    : Rp. ' + jumlah + '</p>');
        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
        setTimeout(function () { newWin.close(); }, 10);
    } else {
        console.error("Baris dengan indeks tersebut tidak ditemukan.");
    }
}
</script>
 

@endsection
