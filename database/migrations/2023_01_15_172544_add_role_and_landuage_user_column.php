<?php

use App\Models\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->renameColumn('name', 'first_name');
            $table->string('last_name');
            $table->string('tel');
            $table->enum('role', ['admin', 'moderator', 'client']);
            $table->enum('language', ['pl', 'en'])->default('pl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->renameColumn('first_name', 'name');
            $table->dropColumn(['last_name', 'tel', 'role', 'language']);
        });
    }
};
