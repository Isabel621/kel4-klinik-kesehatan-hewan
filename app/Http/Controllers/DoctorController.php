<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index() {
        $jadwal_doctor = DB::select('select * from doctors');
        // $price_list = $list_price[0];
        // return $price_list->service;
        return view('page.doctor.index', [
            'doctors' => $jadwal_doctor
        ]);
    }

    public function create( Request $req){
        return view('page.doctor.create',[
            'title' => 'Create Doctor'
        ]);
    }

    public function edit( Request $req, $id){
        // $id = intval($req->input('id'));
        $items = DB::select('select * from doctors where id='. $id);
        // return $items;
        if(count($items) <= 0){
            return "data tidak ditemukan";
        }

        $item = $items[0];
        return view('page.doctor.edit', [
            'doctor' => $item,
        ]);
        $item->update();
    }

    public function simpan( Request $req){
        $name = $req->input('name');
        $time = $req->input('time');

        $sql = "insert into doctors (name, time) value (?, ?)";
        DB::insert($sql, [$name, $time]);

        // echo 'berhasil disimpan';
        return redirect('/doctor')->with('success', 'Berhasil menambahkan dokter');
    }

    public function hapus( $id)
    {
        DB::delete('delete from doctors where id='.$id);
        return redirect('/doctor')->with('success', 'Berhasil menghapus dokter!');
    }

}
