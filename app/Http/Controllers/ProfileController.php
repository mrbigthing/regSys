<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

use Redirect, Input, Auth;

class ProfileController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("profile.view");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("profile.edit");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return "hello world";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view("profile.view");
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view("profile.edit");
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
            'name' => 'required',
        ]);

        $user = User::find($id);
        $user->name = Input::get('name');
        $user->identi_card = Input::get('identi_card');
        $user->phone = Input::get('phone');
        $user->family_members = Input::get('family_members');

        if ($user->save()) {
            return Redirect::to('profile');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
	}

	public function submitProfile($id) {
		$this->validate($request, [
            'name' => 'required',
            'identi_card' => 'required',
            'phone' => 'required'
        ]);

        $activity_id = Input::get('activity_id');

        return $activity_id;

        $user=Auth::user();
        $user->name = Input::get('name');
        $user->identi_card = Input::get('identi_card');
        $user->phone = Input::get('phone');
        $user->family_members = Input::get('family_members');

        if ($user->save()) {
            return Redirect::to('profile');
        } else {
            return Redirect::back()->withInput()->withErrors('编辑失败！');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
        $user->delete();

        return Redirect::to('activities');
	}

}
