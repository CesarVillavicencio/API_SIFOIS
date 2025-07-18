<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiario;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BeneficiariosExport;

class BeneficiariosController extends Controller
{
    public function getAll(Request $request){
        if($request->has('busqueda')) {
            //return 'si';
        }
        $query = Beneficiario::query();

        $query->when($request->busqueda != null, function($b) use ($request){
            
            $b->where('nombre', 'LIKE', '%'.$request->busqueda .'%')->orWhere('apellido','LIKE' , '%'.$request->busqueda .'%');
        });

        $beneficiarios = $query->orderBy('id','desc')->paginate(10);

        return $beneficiarios;
    }

    public function getAllSelect(){
        $query = Beneficiario::query();
        $beneficiarios = $query->orderBy('created_at','desc')->get();
        return $beneficiarios;
    }

    public function getBeneficiario(Request $request){
        $id = $request->id;
        $beneficiario = Beneficiario::findOrFail($id);
        return $beneficiario;
    }

    public function createBeneficiario(Request $request){
        $beneficiario = Beneficiario::create([
            'nombre'        => $request->nombre,
            'apellido'      => $request->apellido,
            'creado_por'    => $request->creado_por
        ]);

        return $beneficiario;
    }

    public function updateBeneficiario(Request $request){
        $id = $request->id;
        // return $request->apellido;
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->nombre           = $request->nombre;
        $beneficiario->apellido         = $request->apellido;
        $beneficiario->actualizado_por  = $request->actualizado_por;
        $beneficiario->save();

        return $beneficiario;
    }

    public function deleteBeneficiario(Request $request){
        // dd('entrnado');
        $id = $request->id;
        $beneficiario = Beneficiario::findOrFail($id);
        $beneficiario->delete();
        
        return $beneficiario;
    }

    public function getExcel(Request $request){
        $results = Beneficiario::all();
        return Excel::download(new BeneficiariosExport($results->toArray()), 'Beneficiarios.xlsx');
    }
}
