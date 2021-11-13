<?php

namespace App\Providers;

use App\Models\Ban;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->registerPolicies();

        /*$ban = Ban::where('ip', $request->ip())->get()->toArray();
        if(count($ban) > 0) {
            return Response::deny('Twój adres IP został zablokowany');
        }*/

        Gate::define('admin', function(User $user) {
            if($user->isAdmin()) {
                return Response::allow();
            } else {
                return Response::deny('Brak uprawnień');
            }
        });
    }
}
