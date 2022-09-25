<?php

namespace App\Http\Controllers\Backend;

use mysqli;
use App\Tenant;
use Illuminate\Http\Request;
use App\Http\Helpers\TenantHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\CollegeRegisterRequest;

class RegisterCollege extends Controller
{
    public function register()
    {
        return view('backend.register-college');
    }
    public function store(Request $request)
    {
	try {
	$name = 'sms_' . $request->college_shorthand;
        $tenant = Tenant::create([
            'name' => $request->college_name,
            'domain' => $request->college_shorthand . '.' . 'sms.symbytel.com',
            'database' => 'sms_' . $request->college_shorthand
        ]);

        $this->createDatabase($name);    
        Artisan::call("tenants:artisan 'migrate --seed --force' --tenant={$tenant->id}");

        return redirect()->route('post-register')->with('message', 'Tenant created');
	    
	} catch(Exception $ex){
		return redirect()->route('post-register')->with('message', $ex);
	
	}
	
       
    }

    public function post_register()
    {
        return view('backend.registration-done');
    }
    public function test()
    {
        Artisan::call('cache:clear');
        return response()->json('Done');
    }
    private function createDatabase($name)
    {
        $conn = new mysqli('localhost', 'root', 'password');
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Creating a database named newDB

        $sql = "CREATE DATABASE $name";

        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully with the $name";
        } else {
            echo "Error creating database: " . $conn->error;
        }

        // closing connection
        $conn->close();
    }
}
