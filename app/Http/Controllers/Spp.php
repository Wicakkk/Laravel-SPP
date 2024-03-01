<?php

namespace App\Http\Controllers;

use App\Models\SppModel;
use Illuminate\Http\Request;


class Spp extends Controller
{
    public function index()
    {
        $pembayaran = SppModel::all();
        $data = [
            'title' => 'Spp | MyApp',
            'active' => 'Spp',
            'pembayaran' => $pembayaran
        ];
        return view('pembayaran.index', $data);
    }

    public function save(Request $request)
    {
        SppModel::create($request->except(['_token', 'simpan']));
        return redirect()->to(url('pembayaran'))->with('dataTambah', 'Data Berhasil Di Tambah');
    }

    public function update(Request $request, $id)
{
    $data = SppModel::findOrFail($id);
    $data->update($request->except(['_token', '_method']));
    return redirect()->to(url('pembayaran'))->with('dataEdit', 'Data Berhasil Diubah');
}

    public function delete($id)
    {
        $data = SppModel::findOrFail($id);
        $data->delete();
        return redirect()->to(url('pembayaran'))->with('dataHapus', 'Data Berhasil Dihapus');
    }
}
