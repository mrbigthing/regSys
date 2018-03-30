<?php namespace App\Http\Controllers\Activities;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Activity;
use App\ActivitiesRegistration;

class ActivitiesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('Activities')->withPages(Activity::orderBy('id', 'desc')->paginate(5));
		//return view('Activities')->withPages(Activity::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$users = ActivitiesRegistration::where(['activity_id'=>$id])->get();
		$user=Auth::user();
		$isUserRegistered = False;
		if (!empty($user)) {
			$count = ActivitiesRegistration::where(['activity_id'=>$id, 'user_id'=>$user->id])->count();
			if ($count > 0) {
				$isUserRegistered = True;
			}
		}
		return view('activities.show')->withPage(Activity::find($id))->with("users", $users)->with("is_registered", $isUserRegistered);
	}

	/**
	 * get all register count
	 *
	 * @return count
	 */
	public function getRegistrationCount($id) {
		$users = ActivitiesRegistration::where(['activity_id'=>$id]);

		$count = 0;

		foreach($users as $user) {
			$count += $user->number+1;
		}

		return $count;
	}
}
