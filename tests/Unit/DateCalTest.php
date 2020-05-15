<?php

namespace Tests\Unit;

use App\Controller\DateCal;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DateCalTest extends TestCase
{
    
	
   public function testAjaxSave()
	{
			
			// Convert the supplied date to timestamp
			$fMin = strtotime("01-01-2020");
			$fMax = strtotime("01-01-2022");

			// Generate a random number from the start and end dates
			$St_date = date("Y-m-d",mt_rand($fMin, $fMax));
			$en_date = date("Y-m-d",mt_rand($fMin, $fMax));
			
			$to=Carbon::parse($St_date);
			$from =Carbon::parse($en_date);
            
            $day_amt = $to->diffInDays($from);
			//$day_amt=10;
			$data = [
					'action' => "Add",
					'submit' => "Add",
					'date1' => $St_date,
					'date2' => $en_date,
					'day_amt' => $day_amt,
					 ];

		//$response = $this->json('POST', '/save',$data);
		
		$response = $this->json('POST', '/AjaxSave',$data);
		$response->assertStatus(200);
	}
	
   public function testSave()
	{
			
			// Convert the supplied date to timestamp
			$fMin = strtotime("01-01-2020");
			$fMax = strtotime("01-01-2022");

			// Generate a random number from the start and end dates
			$St_date = date("Y-m-d",mt_rand($fMin, $fMax));
			$en_date = date("Y-m-d",mt_rand($fMin, $fMax));
			
			$to=Carbon::parse($St_date);
			$from =Carbon::parse($en_date);
            
            $day_amt = $to->diffInDays($from);
			//$day_amt=10;
			$data = [
					'submit' => "Add",
					'date1' => $St_date,
					'date2' => $en_date,
					'day_amt' => $day_amt,
					 ];
		
		$response = $this->json('POST', '/save',$data);
		$response->assertStatus(302);
	}
	
	public function testIndexPage() {
    	
		$response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testIndexGetData() {
       $response =$this->get('/200');
       $response->assertStatus(200);
    }
    
}
