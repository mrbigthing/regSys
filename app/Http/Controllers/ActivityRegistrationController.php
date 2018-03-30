<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Redirect, Input, Auth;
use App\User;
use App\ActivitiesRegistration;
use App\Activity;

class ActivityRegistrationController extends Controller {

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
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$user=Auth::user();

		if (empty($user->name) || empty($user->identi_card) || empty($user->phone)) {
			return View('registration.editProfile')->with('activity_id', $id);
		} else {
			$count = ActivitiesRegistration::where(['activity_id'=>$id, 'user_id'=>$user->id])->count();

			if ($count == 0) {
				$activity = Activity::find($id);
				$maxNumber = $activity->number;

				if(!empty($maxNumber)){
					$users = ActivitiesRegistration::where(['activity_id'=>$id])->get();
					$totalCount = 0;
				    foreach ($users as $user) {
				        $totalCount ++;
				        $totalCount += $user->number;
				    }

				    $potentialCount = $totalCount + 1;

				    if($potentialCount > $maxNumber) {
						return view('registration.fail');
				    } else {
				    	return view('registration.confirm')->with('activity_id', $id);
				    }
				} else {
					return view('registration.confirm')->with('activity_id', $id);
				}
			} else {
				return view('registration.success');
			}
		}
	}

	/**
	 * get all register count
	 *
	 * @return count
	 */
	public function getRegistrationCount($id) {
		$users = ActivitiesRegistration::where(['activity_id'=>$id])->get();

		$count = 0;

		foreach($users as $user) {
			$count += $user->number+1;
		}

		return $count;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id)
	{
		$user=Auth::user();
		if (empty($user->name) || empty($user->identi_card) || empty($user->phone)) {
			return View('registration.editProfile')->with('activity_id', $id);
		} else {
			$count = ActivitiesRegistration::where(['activity_id'=>$id, 'user_id'=>$user->id])->count();

			if ($count == 0) {

				$activity = Activity::find($id);
				$maxNumber = $activity->number;

				$activityReg = new ActivitiesRegistration;
				$activityReg->activity_id = $id;
				$activityReg->user_id = $user->id;
				$activityReg->user_name = $user->name;
				$activityReg->user_identi_card = $user->identi_card;
				$activityReg->user_phone = $user->phone;
				$activityReg->family_members = $user->family_members;
				$family_json = json_decode($user->family_members);
				$activityReg->number=count($family_json);

				if (!empty($maxNumber)) {

					$registrationCount = 0;
					$allUsers = ActivitiesRegistration::where(['activity_id'=>$id])->get();
					foreach($allUsers as $perUser) {
						$registrationCount += $perUser->number+1;//家属个数和自身
					}
					$totalNumber = ($activityReg->number+1) + $registrationCount;

					if ($totalNumber > $maxNumber) {
						return view('registration.fail');
					}
				}

				if ($activityReg->save()) {
					return view('registration.success');
				} else {
					return Redirect::back()->withInput()->withErrors('保存失败！');
				}
			} else {
				return view('registration.success');
			}

			
		}
	}

	public function submitProfile(Request $request, $id) {
		$this->validate($request, [
            'name' => 'required',
            'identi_card' => 'required',
            'phone' => 'required'
        ]);

        $user=Auth::user();
        $user->name = Input::get('name');
        $user->identi_card = Input::get('identi_card');
        $user->phone = Input::get('phone');
        $user->family_members = Input::get('family_members');

        if ($user->save()) {
            return view('registration.confirm')->with('activity_id', $id);
        } else {
            return Redirect::back()->withInput()->withErrors('编辑失败！');
        }
	}

	public function editProfile($id) {
		return View('registration.editProfile')->with('activity_id', $id);
	}

	/**
	 * export users
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function export($id) {
		$users = ActivitiesRegistration::where(['activity_id'=>$id])->get();
		return view('registration.exportExcel')->with('users', $users);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user=Auth::user();
		ActivitiesRegistration::where(['activity_id'=>$id, 'user_id'=>$user->id])->delete();
		return Redirect::to('activities');
	}

}
