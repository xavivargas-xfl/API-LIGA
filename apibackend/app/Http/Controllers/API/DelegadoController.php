<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delegado;
use Illuminate\Support\Facade\file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DelegadoController extends Controller
{
    public function index($id)
    {
        $jugador = Delegado::find($id);
        return $jugador;
    }
    public function store(Request $request){
        //dd($request);
        $jugador = new Delegado;
        $jugador->name = $request->input('name');
        $jugador->apellido = $request->input('apellido');
        $jugador->ci = $request->input('ci');
        $jugador->fechaNac = $request->input('fechaNac');
        $jugador->foto = $request->input('foto');

         //---------Guardar Imagen -------
        $sol_filename=(string)Str::uuid();
        if($request->hasFile("foto")){
            $file=$request->file("foto");
            $name_sol = $sol_filename.".".$file->guessExtension();
                        //$ruta = public_path("pdf/".$name_sol);
            if($file->guessExtension()=="png" || "jpg"){
                $request->file('foto')->storeAs('/public/imagenes/' , $name_sol);
                $jugador->foto =  $name_sol;
                //copy($file, $ruta);
            }else{
                dd("NO ES UN PNG");
            }
        }


        $jugador->save();

        return response()->json([
            'status' => 200,
            'message'=> 'se aniadido estudiante exitosamente',
        ]);
    }

    public function show(){
        //dd($request)
        $jugador = Delegado::All();
        return $jugador;


    }

    public function update(Request $request, $id){

        $jugador = Delegado::find($id);
        $jugador -> update($request->all());

        return response()->json([
            'status' => 200,
            'message'=> 'se actualizo jugador exitosamente',
        ]);
    }

    public function destroy( $id){
        //dd($request);
        $jugador = Delegado::destroy($id);

        return $jugador;
        response()->json([
            'status' => 200,
            'message'=> 'se elimino jugador exitosamente',
        ]);
    }
}

