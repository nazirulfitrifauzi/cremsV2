<?php
namespace App\Http\Controllers;

use App\Client;
use App\ClientUser;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except(
                    [$request->get('password') ? '' : 'password']
                )
        );

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User  $user)
    {
        // $user->delete();
        // return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));


        $user->delete();

        //  Return response
        return response()->json([
            'success' => true,
            'message' => "User ". $user->name ." has been rejected.",
        ]);
    }

    public function activateUserPage()
    {
        $client = Client::all();

        return view('users.request', compact('client'));
    }

    public function activateUser(Request $request, $id)
    {
        $name = User::whereId($id)->value('name');
        $email = User::whereId($id)->value('email');

        $clientuser = new ClientUser([
            'name'          => $name,
            'email'         => $email,
            'client_id'     => $request->get('client')
        ]);

        $clientuser->save();

        $client_id = ClientUser::where('name',$name)
                                    ->where('email',$email)
                                    ->value('id');

        User::whereId($id)->update([
            'role'      => '3',
            'active'    => '1',
            'client_id' => $client_id
        ]);
        
        session()->flash('success', 'User successfully updated.');
        return back();
    }

}
