<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    
    public function sendMail(){

        $details = [
            'title' => 'Testing Email',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam facilis atque mollitia esse alias, beatae culpa ullam nobis reprehenderit temporibus impedit. Fugiat quis blanditiis praesentium! Temporibus quia voluptatibus dolores consequatur!'
        ]
    }
}
