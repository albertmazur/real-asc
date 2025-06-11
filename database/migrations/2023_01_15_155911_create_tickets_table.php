<?php

use App\Models\Event;
use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table)
        {
            $table->id();
            $table->string('number');
            $table->date('dateBuy');
            $table->time('timeBuy');
            $table->string('stripe_payment_id');
            $table->enum('state', ['bought', 'returned']);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Event::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
