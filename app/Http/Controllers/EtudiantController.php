<?php

namespace App\Http\Controllers;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Etudiant::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addEtudiant(Request $request)
    {

        $request->validate([
        'nom' =>'required',
        'prenom' =>'required',
        // 'dateNaissance' =>'required',
        // 'numCarte' =>'required',
        // 'numSocial' =>'required',
        // 'numTel' =>'required',
        // 'diplome' =>'required',
        ]);

        return Etudiant::create($request->all());
    }
    public function completeEtudiant(Request $request, $id)
    {

        $request->validate([

        'dateNaissance' ,
        'numCarte',
        'numSocial',
        'numTel' ,
        'diplome' ,
        ]);

        $Etudiant = Etudiant::find($id);
        $Etudiant->update($request->all());
        return $Etudiant;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Etudiant::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Etudiant = Etudiant::find($id);
        $Etudiant->update($request->all());
        return $Etudiant;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return Etudiant::destroy($id);
    }

    /**
     * Search for a name.
     */
    public function search(string $name)
    {
       return Etudiant::where('name', 'like' , '%' , $name , '%' )->get();
    }
}
