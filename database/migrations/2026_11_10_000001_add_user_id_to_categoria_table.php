<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Las categorías pasan a ser privadas: cada usuario tiene las suyas.
     *
     * La columna se añade nullable para poder migrar datos existentes y se
     * rellena a partir del usuario de la primera tarea de cada categoría.
     * Si una categoría no tiene tareas, se asigna al primer usuario.
     */
    public function up(): void
    {
        Schema::table('categoria', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('usuarios')
                ->nullOnDelete();

            $table->index(['user_id', 'name']);
        });

        $defaultUserId = DB::table('usuarios')->orderBy('id')->value('id');

        if ($defaultUserId !== null) {
            DB::table('categoria')
                ->select('id')
                ->orderBy('id')
                ->each(function ($categoria) use ($defaultUserId) {
                    $ownerId = DB::table('tareas')
                        ->where('categoria_id', $categoria->id)
                        ->whereNotNull('usuario_id')
                        ->orderBy('id')
                        ->value('usuario_id');

                    DB::table('categoria')
                        ->where('id', $categoria->id)
                        ->update(['user_id' => $ownerId ?? $defaultUserId]);
                });
        }
    }

    public function down(): void
    {
        Schema::table('categoria', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'name']);
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
