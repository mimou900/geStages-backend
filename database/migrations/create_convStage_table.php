<?php
use App\Models\User;
use App\Models\chefDepartement;
use App\Models\maitreDeStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('convStage', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->date('dateDemande');
            $table->string('statut')->nullable();
            $table->string('AvisChef')->nullable();
            $table->string('AvisMaitre')->nullable();
            $table->longText('Description');
            $table->integer('note')->nullable();
            $table->foreign('moyDabsence')->references('convStage')->on('presance');
            $table->foreignIdFor(User::class, 'etudiant_id')->nullable();
            $table->foreignIdFor(User::class, 'maitreStage_id')->nullable();
            $table->foreignIdFor(User::class, 'chefDepartement_id')->nullable();
            $table->text('titre');
            $table->timestamp('failed_at')->useCurrent();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convStage');
    }
};
