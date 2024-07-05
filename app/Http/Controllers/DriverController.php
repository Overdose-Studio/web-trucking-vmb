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

    // Create: show form create driver
    public function create()
    {
        return view('admin.driver.create');
    }
}
