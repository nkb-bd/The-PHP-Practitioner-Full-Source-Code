<?php

namespace App\Controllers;

use App\Core\App;

class UsersController
{
    /**
     * Show all users.
     */
    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('users', compact('users'));
    }

    /**
     * Store a new user in the database.
     */
    public function store()
    {
        App::get('database')->insert('users', [
            'name' => $_POST['name']
        ]);
    
    
        echo "User inserted successfully. Attempting to redirect...<br>";
    
        if (headers_sent()) {
            echo "Headers already sent. Using JavaScript redirect.<br>";
            echo "<script>window.location.href = '/users';</script>";
            echo '<noscript><meta http-equiv="refresh" content="0;url=/users"></noscript>';
            exit();
        } else {
            echo "Headers not sent. Using PHP redirect.<br>";
            return redirect('users');
        }
    }
}
