<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->text('gallery')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        $lp = 0;

        $faker = Faker\Factory::create();
        for($i = 30; $i > 0; $i--) {
            $lp++;
            if($lp > 18) $lp = 1;

            DB::table('blogs')->insert([
                'title' => $faker->text(50),
                'description' => $faker->text(255),
                'keywords' => str_replace(' ', ', ', $faker->text(100)),
                'gallery' => 'example/img-'.$lp.'.jpg',
                'content' => '<p>'.$faker->text(1000).'</p>',
                'created_at' => Carbon::now()->addDays(-$i),
                'updated_at' => Carbon::now()->addDays(-$i),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
