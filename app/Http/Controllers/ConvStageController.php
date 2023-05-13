<?php


namespace App\Http\Controllers;
use App\Models\ConvStage;
use Illuminate\Http\Request;

class ConvStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConvStage::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addStage(Request $request)
    {

        $request->validate([
            'titre' =>'required',
            'dateDebut' => 'required',
            'dateFin' =>'required',
            'description' =>'required'
        ]);

        return ConvStage::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ConvStage::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ConvStage = ConvStage::find($id);
        $ConvStage->update($request->all());
        return $ConvStage;
    }
    public function accept(string $id)
{
    $ConvStage = ConvStage::find($id);
    $ConvStage->update(['statut' => 'Accepté']);
    return $ConvStage;
}

    public function reject(string $id)
    {
        $ConvStage = ConvStage::find($id);
    $ConvStage->update(['statut' => 'Refusé']);
    return $ConvStage;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return ConvStage::destroy($id);
    }

    /**
     * Search for a name.
     */
    public function search(string $name)
    {
       return ConvStage::where('name', 'like' , '%' , $name , '%' )->get();
    }
}


// $ConvStage = new ConvStage;
// $ConvStage->titre=$req->input('titre');
// $ConvStage->dateDebut=$req->input('dateDebut');
// $ConvStage->dateFin=$req->input('dateFin');
// $ConvStage->description=$req->input('description');
// $ConvStage->maitreStage=$req->input('maitreStage');
// $ConvStage->save();
// return $ConvStage;