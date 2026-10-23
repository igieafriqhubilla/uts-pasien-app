<?php

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
Schema::create('patients', function (Blueprint $table) {
$table->id();
$table->string('no_rm')->unique();   // nomor rekam medis, tidak 
//boleh kembar
$table->string('nama');
$table->integer('usia');
$table->string('alamat');
$table->string('diagnosa');
$table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
