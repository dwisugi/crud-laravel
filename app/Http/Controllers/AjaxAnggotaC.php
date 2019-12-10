<?php 

namespace App\Http\Controllers;
 use App\Anggota;
use Illuminate\Http\Request;
use Redirect, Response;

class AjaxAnggotaC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['anggota'] = Anggota::orderBy('id','desc')->paginate(5);
        return view('ajax-anggota',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anggotaId = $request->anggota_id;
        $anggota = Anggota::updateOrCreate(['id'=>$anggotaId],
        ['name'=>$request->name]);
        return Response::json($anggota);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $where = array('id' => $id);
        $anggota  = Anggota::where($where)->first();
    
        return Response::json($anggota);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = Anggota::where('id',$id)->delete();
   
        return Response::json($anggota);
    }
}
