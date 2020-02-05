<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientUser;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name'       => ['required', 'string'],
            'address'           => ['required', 'string']
        ]);

        $client = new Client([
            'client_name'         =>  $request->get('client_name'),
            'address'             =>  $request->get('address'),
        ]);
        
        $client->save();
        
        session()->flash('success', 'Client successfully added.');
        return redirect()->route('client.index');
    }

    public function show(Client $client)
    {
        //
    }

    public function edit($id)
    {
        $client = Client::whereId($id)->first();
        return view('client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_name'       => ['required', 'string'],
            'address'           => ['required','string']
        ]);

        $data = request([
            'client_name',
            'address'
        ]);

        Client::whereId($id)->update($data);

        session()->flash('success', 'Client info successfully updated.');
        return back();
    }

    public function destroy($id)
    {
        $client = Client::whereId($id)->value('client_name');
        Client::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Client ". $client ." has been deleted.",
        ]);
    }

    public function getUser()
    {
        return view('client.user');
    }

    public function editUser($id)
    {
        $client = Client::all();
        $clientuser = ClientUser::whereId($id)->first();
        return view('client.edituser', compact('client', 'clientuser'));
    }

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name'       => ['required', 'string'],
            'email'      => ['required','email']
        ]);

        $data = request([
            'name',
            'email',
            'client_id'
        ]);

        ClientUser::whereId($id)->update($data);

        session()->flash('success', 'Client info successfully updated.');
        return back();
    }

    public function destroyUser($id)
    {
        $name = ClientUser::whereId($id)->value('name');
        ClientUser::destroy($id);

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "Client ". $name ." has been deleted.",
        ]);
    }
}
