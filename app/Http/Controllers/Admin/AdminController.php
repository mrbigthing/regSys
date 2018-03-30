<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

use Redirect, Input, Auth;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('superAdminAuth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('admin.show')->withPages(User::whereRaw('is_admin is null OR is_admin <> 2')->orderBy('name', 'asc')->paginate(15));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);
		return view("admin.view")->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return view("admin.edit")->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function reset($id)
	{
		$user = User::find($id);
		$user->password = Hash::make('123456');//重置密码为123456
		if ($user->save()) {
            return Redirect::to('/admin');
        } else {
            return Redirect::back()->withInput()->withErrors('重置失败！');
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function addAsAdmin($id)
	{
		$user = User::find($id);
		$user->is_admin = 1;
		if ($user->save()) {
            return Redirect::to('/admin');
        } else {
            return Redirect::back()->withInput()->withErrors('添加失败！');
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function removeFromAdmin($id)
	{
		$user = User::find($id);
		$user->is_admin = null;
		if ($user->save()) {
            return Redirect::to('/admin');
        } else {
            return Redirect::back()->withInput()->withErrors('移除失败！');
        }
	}


	/**
	 * Show the form for deleting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$user = User::find($id);
		$user->delete();
		return $id;
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
            return Redirect::to('/admin');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
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
		//
	}

}
