<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class DateCalculations extends Model
{
	
	public static function getuserData($id=0){

    if($id==0){
      $value=DB::table('date_calculations')->orderBy('id', 'asc')->get(); 
    }else{
      $value=DB::table('date_calculations')->where('id', $id)->first();
    }
    return $value;
  }

  public static function insertData($data){
    $value=DB::table('date_calculations')
								->where('date1', $data['date1'])
								->where('date2', $data['date2'])
								->get();
    if($value->count() == 0){
      DB::table('date_calculations')->insert($data);
      return 1;
     }else{
       return 0;
     }
 
  }

  public static function updateData($id,$data){
    DB::table('date_calculations')
      ->where('id', $id)
      ->update($data);
  }

  public static function deleteData($id){
    DB::table('date_calculations')->where('id', '=', $id)->delete();
  }
}

