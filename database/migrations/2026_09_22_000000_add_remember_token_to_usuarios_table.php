<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Columna necesaria para que funcione la opción "Recordarme" del login.
     * Es aditiva y nullable, por lo que no afecta a los registros existentes.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
};
