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

    // Store: store driver to database
    public function store(Request $request)
    {
        // Validate form
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric|min:0',
            'phone' => 'required|string',
            'nik' => 'required|string',
            'sim' => 'required|string',
            'address' => 'required|string',
        ]);

        // Store driver to database
        $driver = new Driver;
        $driver->name = $request->name;
        $driver->age = $request->age;
        $driver->phone = $request->phone;
        $driver->nik = $request->nik;
        $driver->sim = $request->sim;
        $driver->address = $request->address;
        $driver->save();

        return redirect()->route('driver.index')->with('success', 'Driver ' . $driver->name . ' created successfully.');
    }

    // Edit: show form edit driver
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.driver.edit', compact('driver'));
    }

    // Update: update driver to database
    public function update(Request $request, $id)
    {
        // Validate form
        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric|min:0',
            'phone' => 'required|string',
            'nik' => 'required|string',
            'sim' => 'required|string',
            'address' => 'required|string',
        ]);

        // Update driver to database
        $driver = Driver::findOrFail($id);
        $driver->name = $request->name;
        $driver->age = $request->age;
        $driver->phone = $request->phone;
        $driver->nik = $request->nik;
        $driver->sim = $request->sim;
        $driver->address = $request->address;
        $driver->save();

        return redirect()->route('driver.index')->with('success', 'Driver ' . $driver->name . ' updated successfully.');
    }
}
