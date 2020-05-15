<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\DateCalculations;

use Carbon\Carbon;


class DateCal extends Controller
  {
    /**
	User ur56d8nzfdags is created with password qthjkbydyspt
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = 0)
      {
        
        // Fetch all records
        $userData['data'] = DateCalculations::getuserData();
        
        $userData['edit'] = $id;
        
        // Fetch edit record
        if ($id > 0)
          {
            $userData['editData'] = DateCalculations::getuserData($id);
          }
        
        // Pass to view
        return view('index')->with("userData", $userData);
      }
    
    public function save(Request $request)
      {
        
        if ($request->input('submit') != null)
          {
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');
            
            $to   = Carbon::parse($date1);
            $from = Carbon::parse($date2);
            
            $day_amt = $to->diffInDays($from);
            
            // Update record
            if ($request->input('editid') != null)
              {
                $editid = $request->input('editid');
                //  var_dump($_POST);
                
                if ($date1 != '' && $date2 != '' && $day_amt != '' && $editid != '')
                  {
                    $data = array(
                        'date1' => $date1,
                        "date2" => $date2,
                        "day_amt" => $day_amt
                    );
                    
                    // Update
                    DateCalculations::updateData($editid, $data);
                    
                    Session::flash('message', 'Update successfully.');
                    
                  }
                
              }
            else // Insert record
              {
                
                
                if ($date1 != '' && $date2 != '' && $day_amt != '')
                  {
                    $data = array(
                        'date1' => $date1,
                        "date2" => $date2,
                        "day_amt" => $day_amt
                    );
                    
                    // Insert
                    $value = DateCalculations::insertData($data);
                    
                    if ($value)
                      {
                        Session::flash('message', 'Insert successfully.');
                      }
                    else
                      {
                        Session::flash('message', 'Data already exists.');
                      }
                    
                  }
              }
            
          }
		  
        return redirect()->action('DateCal@index',['id'=>0]);
        
      }
    public function AjaxSave(Request $request)
      {
        $_POST['statusCode'] = 201;
        if ($request->input('action') == 'Add')
          {
            
            
            $date1   = $request->input('date1');
            $date2   = $request->input('date2');
            $day_amt = $request->input('day_amt');
            
            
            // Insert record
            
            if ($date1 != '' && $date2 != '' && $day_amt != '')
              {
                $data = array(
                    'date1' => $date1,
                    "date2" => $date2,
                    "day_amt" => $day_amt
                );
                
                // Insert
                $value = DateCalculations::insertData($data);
                if ($value)
                  {
                    $_POST['statusCode'] = 200;
                    Session::flash('message', 'Insert successfully.');
                  }
                else
                  {
                    Session::flash('message', 'Data already exists.');
                  }
                
              }
          }
        
     //   echo json_encode($_POST);
		
         return response()->json(array('msg'=> $msg), $_POST['statusCode']);
      }
    
    public function deleteUserData($id = 0)
      {
        
        if ($id != 0)
          {
            // Delete
            DateCalculations::deleteData($id);
            
            Session::flash('message', 'Delete successfully.');
            
          }
        return redirect()->action('DateCal@index',['id'=>0]);
      }
  }