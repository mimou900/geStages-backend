<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\ChefDepartement;
use App\Models\MaitreDeStage;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        $etudiants = Etudiant::all();
        $chefDepartements = ChefDepartement::all();
        $maitreStages = MaitreDeStage::all();

        foreach ($etudiants as $etudiant) {
            $user = $etudiant->user;
        
            if ($user) { 
                $user->role = 2;
                $user->save();
            }
        }
        

        foreach ($chefDepartements as $chefDepartement) {
            $user = $chefDepartement->user;
            $user->role_id = 1; 
            $user->save();
        }

        foreach ($maitreStages as $maitreStage) {
            $user = $maitreStage->user;
            $user->role_id = 3; 
            $user->save();
        }
    }
}
