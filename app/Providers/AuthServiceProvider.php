<?php

namespace App\Providers;

use App\Models\User; // <-- Garanta que este import exista
use Illuminate\Support\Facades\Gate; // <-- Garanta que este import exista
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Esta linha geralmente já existe
        $this->registerPolicies();

        // ADICIONE O SEU GATE EXATAMENTE AQUI
        Gate::define('manage-users', function (User $user) {
            // Verifica se a relação 'role' existe E se o nome dela é 'Gerente'
            return $user->role && $user->role->name === 'Gerente';
        });
    }
}
