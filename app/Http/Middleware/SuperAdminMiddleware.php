<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class SuperAdminMiddleware {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				//return response('Unauthorized.', 401);
				return view('errors.401');
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		} else{
			$user = $this->auth->user();
			if (is_null($user->is_admin) || $user->is_admin<2) {
				//return response('Unsupport operate.', 401);
				return view('errors.401');
			}
		}

		return $next($request);
	}
}
