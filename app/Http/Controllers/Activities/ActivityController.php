<?php namespace App\Http\Controllers\Activities;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Activity;

use Redirect, Input, Auth;

class ActivityController extends Controller {

	public function __construct()
	{
		$this->middleware('adminAuth');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('activities.create');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('activities.edit')->withPage(Activity::find($id));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
            'title' => 'required|unique:activities|max:255',
            'start_register_time' => 'required',
            'end_register_time' => 'required',
        ]);

        $activity = new Activity;
        $activity->title = Input::get('title');
        $activity->content = Input::get('content');
        $activity->visacontent = Input::get('visacontent');
        $activity->start_register_time = Input::get('start_register_time');
        $activity->end_register_time = Input::get('end_register_time');
        $activity->number = 9998;
        //$page->user_id = 1;//Auth::user()->id;

        if ($activity->save()) {
            return Redirect::to('activities');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
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
            'title' => 'required|max:255',
            'start_register_time' => 'required',
            'end_register_time' => 'required',
        ]);

        $activity = Activity::find($id);
        $activity->title = Input::get('title');
        $activity->content = Input::get('content');
        $activity->start_register_time = Input::get('start_register_time');
        $activity->end_register_time = Input::get('end_register_time');
        $activity->number = Input::get('number');
        //$page->user_id = 1;//Auth::user()->id;

        if ($activity->save()) {
            return Redirect::to('activities');
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
		$activity = Activity::find($id);
        $activity->delete();

        return Redirect::to('activities');
	}

}
