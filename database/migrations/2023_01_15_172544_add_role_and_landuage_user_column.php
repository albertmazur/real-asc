<?php

use App\Enums\Language;
use App\Enums\UserRole;
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
            $table->enum('role', array_column(UserRole::cases(), 'value'))->default(UserRole::USER->value);
            $table->enum('language', array_column(Language::cases(), 'value'))->default(Language::PL->value);
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
