<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct(private ClientService $clients){}

    public function index(){
        $list = $this->clients->paginate(Auth::id(), 10);
        return view('clients.index', compact('list'));
    }

    public function create(){
        return view('clients.create');
    }

    public function store(ClientRequest $request){
        $this->clients->create(Auth::id(), $request->validated());
        return redirect()->route('clients.index')->with('success','Client created.');
    }

    public function edit(Client $client){
        abort_unless($client->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        return view('clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client){
        abort_unless($client->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $this->clients->update($client, $request->validated());
        return redirect()->route('clients.index')->with('success','Client updated.');
    }

    public function destroy(Client $client){
        abort_unless($client->user_id === Auth::id() || Auth::user()->isAdmin(), 403);
        $this->clients->delete($client);
        return redirect()->route('clients.index')->with('success','Client deleted.');
    }
}
