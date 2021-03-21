<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Log;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return User|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(array $input)
    {
        $default = DB::table('permition')
            ->where('default', '=', '1')
            ->get();

        Log::info('Count: ' . count($default));
        if(count($default) == 0){

            header('Location: ' . '/new-user-error', true, 302);
            die();

        }else{
            $default = $default[0]->id;
        }

        Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'nick' => ['required', 'string', 'max:50',  'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'nick' => $input['nick'],
            'email' => $input['email'],
            'permition' => $default,
            'password' => Hash::make($input['password']),

        ]);
    }

}
