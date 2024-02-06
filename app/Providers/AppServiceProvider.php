<?php

namespace App\Providers;

use App\Models\Pelamar;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('user', function(User $user){
        //     $role_name = UserRole::join('users', 'user_role.id_user', '=', 'users.id')
        //     ->join('role', 'user_role.id_role', '=', 'role.id_role')
        //     ->select(DB::raw('users.username, users.email, role.nama_role as role'))
        //     ->where('email', $user->email) 
        //     ->get()
        //     ->toArray();

        //     return $role_name[0]['role'] == 'user';
        // });

        Gate::define('user', function(User $user){
            return $user->role == 'user';
        });

        Gate::define('admin', function(User $user){
            return $user->role == 'admin';
        });

        Blade::directive('currency', function ($expression) {
            return "<?php echo 'Rp ' . number_format($expression, 2, ',', '.'); ?>";
        });

        Pelamar::unguard();
    }

}
