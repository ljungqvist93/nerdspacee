<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('facts', function (Blueprint $table) {
            $table->boolean('published')->default(false)->after('length');
        });
    }

    public function down(): void
    {
        Schema::table('facts', function (Blueprint $table) {
            $table->dropColumn('published');
        });
    }
};