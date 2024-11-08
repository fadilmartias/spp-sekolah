<?php

namespace App\Http\Controllers;

class GithubController extends Controller
{
    public function autoDeploy()
    {
        // $path = "/home/dila9917/php_app/demo-buckles/deploy-auto.sh";
        // $output = shell_exec($path);
        // echo $output;
        // Return OK response
        header("HTTP/1.1 200 OK");
    }
}
