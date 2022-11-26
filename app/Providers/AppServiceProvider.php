<?php

namespace App\Providers;

use App\Exceptions\PrevalidationPassedException;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(ValidatesWhenResolved::class, function ($request) {
            $request->throwIfPrevalidate();
        });

        Request::macro('throwIfPrevalidate', function () {
            if ($this->has('prevalidate')) {
                throw new PrevalidationPassedException;
            }
        });

        Request::macro('validate', function (array $rules, ...$params) {
            validator()->validate($this->all(), $rules, ...$params);
            $this->throwIfPrevalidate();
        });
    }
}
