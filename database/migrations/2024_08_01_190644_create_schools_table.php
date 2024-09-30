<?php

use App\SchoolStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('status')->default(SchoolStatus::IN_ACTIVE);
            $table->timestamps();
        });
        DB::table('schools')->insert([
            'name'        => 'School 1',
            'description' => 'School 1',
            'status'      =>  1,
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
