<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    // Index: show all drivers
    public function index()
    {
        $drivers = Driver::orderBy('name')->get();
        return view('admin.driver.index', compact('drivers'));
    }
}
