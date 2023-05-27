<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\chefDepartement;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Etudiant;
use App\Models\MaitreDeStage;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        if ($request->role === 2) {
            // Create Etudiant
            $etudiant = Etudiant::create([
                'id' => $user->id,
            ]);
        } elseif ($request->role === 3) {
            // Create MaitreDeStage
            $maitreDeStage = MaitreDeStage::create([
                'id' => $user->id,
            ]);
        }elseif ($request->role === 1) {
            
            $chefDepartement = chefDepartement::create([
                'id' => $user->id,
            ]);
        }

        Auth::login($user);

        return response()->noContent();
    }
}
