<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function showclients(){
        try {
            $result = DB::stament('call sp_showclientes');
            return response()->json($result);
        } catch (\Throwable $th) {
            //throw $th;
        }
       
    }

    public function insertClient(Request $request){
        $name = $request->input('name');
        $dbo = $request->input('dbo');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $addres = $request->input('addres');
        DB::select('call sp_insertclients(?,?,?,?,?)' , [$name,$dbo,$phone,$email,$addres]);
        return response()->json(['message' => 'Client inserted']);
    }

    public function insertPayments(Request $request){
        $cliente_id = $request->input('id_client');
        $amount = $request->input('amount');
        $transaction_id = $request->input('transaction_id');
        $fecha = $request->input('fecha');
        DB::select('call sp_insertPayments(?,?,?,?)' , [$cliente_id,$amount,$transaction_id,$fecha]);
        return response()->json(['message' => 'payments inserted']);
    }

    public function deleteClient($id){
        $result = DB::statement('call sp_deleteclients(?)',[$id]);
        if ($result) {
            return response()->json(['message' => 'client deleted']);

        } else {
            return response()->json(['message' => 'cliente no encontrado' ]);
        }
    }

    public function updateClient(Request $request ,$id){
        $name = $request->input('name');
        $dbo = $request->input('dbo');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $addres = $request->input('addres');

        $result = DB::select('CALL sp_updateClient(?, ?, ?, ?, ?, ?)', [$id, $name, $dbo, $phone, $email, $address]);

    }
}
