<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->unique();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->text('gallery')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('constant')->default(0);
            $table->timestamps();
        });

        DB::table('pages')->insert([
            [
                'url' => 'regulamin',
                'title' => 'Regulamin',
                'content' => '<p>Treść regulaminu...</p>',
                'constant' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'url' => 'polityka-prywatnosci',
                'title' => 'Polityka prywatności',
                'content' => '<p>Treść polityki prywatności...</p>',
                'constant' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
