<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    // Index: show all clients
    public function index()
    {
        $clients = Client::all()->sortBy('name');
        return view('admin.clients.index', compact('clients'));
    }

    // Create: show the form to create new client
    public function create()
    {
        return view('admin.clients.create');
    }

    // Store: when client submit the form to create new client
    public function store(Request $request)
    {
        // Validate the form
        $request->validate([
            'name' => 'required',
        ]);

        // Create new client
        $client = new Client();
        $client->name = $request->name;
        $client->save();

        // Redirect to client index
        return redirect()->route('client.index');
    }

    // Edit: show the form to edit client
    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.clients.edit', compact('client'));
    }

    // Update: when client submit the form to edit client
    public function update(Request $request, $id)
    {
        // Validate the form
        $request->validate([
            'name' => 'required',
        ]);

        // Update client
        $client = Client::find($id);
        $client->name = $request->name;
        $client->save();

        // Redirect to client index
        return redirect()->route('client.index');
    }

    // Delete: delete client
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        // Redirect to client index
        return redirect()->route('client.index');
    }
}
