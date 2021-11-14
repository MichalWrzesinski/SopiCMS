<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0)->index();
            $table->integer('user_id')->default(0)->index();
            $table->integer('category_id')->default(0)->index();
            $table->dateTime('validity')->nullable()->index();
            $table->dateTime('premium')->nullable()->index();
            $table->float('price')->default(0)->index();
            $table->string('title');
            $table->smallInteger('region')->default(0)->index();
            $table->string('city')->nullable()->index();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            [
                'key' => 'item.validity',
                'value' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'item.premium.validity',
                'value' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'item.premium.price',
                'value' => 9.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $lp = 0;

        $faker = Faker\Factory::create();
        for($i = 100; $i > 0; $i--) {
            $lp++;
            if($lp > 18) $lp = 1;

            $userId = rand(1, 52);

            DB::table('items')->insert([
                'status' => 1,
                'user_id' => $userId,
                'category_id' => rand(6, 20),
                'validity' => Carbon::now()->addDays(30),
                'premium' => ((rand(0, 9) == 0) ? Carbon::now()->addDays(7) : null),
                'price' => rand(1, 100)*10,
                'title' => $faker->text(50),
                'region' => rand(1, 16),
                'city' => $faker->city,
                'content' => $faker->text(500),
                'created_at' => Carbon::now()->addDays(-$i),
                'updated_at' => Carbon::now()->addDays(-$i),
            ]);

            $id = DB::getPdo()->lastInsertId();

            DB::table('galleries')->insert([
                'user_id' => $userId,
                'module' => 'items',
                'module_id' => $id,
                'image' => 'example/img-'.$lp.'.jpg',
                'cover' => 1,
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
        Schema::dropIfExists('items');
    }
}
