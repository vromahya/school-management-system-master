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
            $DBname = 'sms_' . $request->college_shorthand;

            $tenant = Tenant::create([
                'name' => $request->college_name,
                'domain' => $request->college_shorthand . '.' . 'localhost',
                'database' => $DBname
            ]);

            $username = $request->username;
            $password = $request->password;
            $name = $request->name;
            $email = $request->email;


            $this->createDatabase($DBname);

            Artisan::call("tenants:artisan 'migrate --seed --force' --tenant={$tenant->id}");

            $this->seedUser($DBname, $username, $password, $name, $email);
            $domain = $request->college_shorthand;
            $url = $domain . '.' . 'localhost:8000/dashboard';

            return redirect()->away($url);
        } catch (\Exception $ex) {

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
        $conn = new mysqli('localhost', env('DB_USERNAME', 'root'), env('DB_PASSWORD', 'mysql'));
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
    private function seedUser($DBname, $username, $password, $name, $email)
    {
        $conn = new mysqli('localhost', env('DB_USERNAME', 'root'), env('DB_PASSWORD', 'mysql'), $DBname);
        // Check connection
        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        }
        // Creating a database named newDB
        $encryptedPassword = bcrypt($password);

        $sql = "INSERT INTO users (username, password, email, name) VALUES ('$username', '$encryptedPassword', '$email', '$name')";

        $conn->query($sql);

        $sql = "SELECT id FROM users WHERE username = '$username'";

        $res = $conn->query($sql);

        $row = $res->fetch_assoc();

        $id = $row["id"];

        $sql = "INSERT INTO user_roles(user_id, role_id) VALUES ($id, 1)";

        if ($conn->query($sql) === TRUE) {

            echo "User with username $username created";
        } else {
            echo "Error creating user " . $conn->error;
        }
        // closing connection
        $conn->close();
    }
}
