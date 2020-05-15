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
			$current_dt = Carbon::now()->toDateTimeString();
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');
            
			try {
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
							"day_amt" => $day_amt,
							"updated_at" => $current_dt
						);
						
						// Update
						DateCalculations::updateData($editid, $data);
						
						Session::flash('message', 'Update successfully.');
						
					  }
					return redirect()->action('DateCal@index',['id'=>$editid]);
				  }
				else // Insert record
				  {
					
					if ($date1 != '' && $date2 != '' && $day_amt != '')
					  {
						$data = array(
							'date1' => $date1,
							"date2" => $date2,
							"day_amt" => $day_amt,
							"created_at" => $current_dt,
							"updated_at" => $current_dt
							
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
            } catch (\Exception $e) {
				Session::flash('message', 'Invalid Date Structure.');
			}
          }
		  
        return redirect()->action('DateCal@index',['id'=>0]);
        
      }
    public function AjaxSave(Request $request)
      {
        $_POST['statusCode'] = 201;
        if ($request->input('action') == 'Add')
          {
            try {
				$current_dt = Carbon::now()->toDateTimeString();
				$date1   = Carbon::parse($request->input('date1'))->format("Y-m-d");
				$date2   = Carbon::parse($request->input('date2'))->format("Y-m-d");
				$day_amt = $request->input('day_amt');
				
				
				// Insert record
				
				if ($date1 != '' && $date2 != '' && $day_amt != '')
				  {
					$data = array(
						'date1' => $date1,
						"date2" => $date2,
						"day_amt" => $day_amt,
						"created_at" => $current_dt,
						"updated_at" => $current_dt
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
			}catch (\Exception $e) {
				$_POST['statusCode'] = 201;
				Session::flash('message', 'Invalid Date Structure.');
			}
          }
		  
        echo json_encode($_POST);
        
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
  