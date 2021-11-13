<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(0);
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'type' => 9,
                'name' => 'Admin',
                'email' => 'admin@webhome.pl',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('haslo123'),
                'avatar' => null,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'type' => 0,
                'name' => 'User',
                'email' => 'user@webhome.pl',
                'status' => 1,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('haslo123'),
                'avatar' => null,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $lp = 0;

        $faker = Faker\Factory::create();
        for($i = 50; $i > 0; $i--) {
            $lp++;
            if($lp > 18) $lp = 1;

            DB::table('users')->insert([
                'type' => 0,
                'name' => $faker->userName,
                'email' => $faker->email,
                'status' => 1,
                'email_verified_at' => Carbon::now()->subDays($i),
                'password' => Hash::make('haslo123'),
                'avatar' => 'example/img-'.$lp.'.jpg',
                'remember_token' => null,
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
        Schema::dropIfExists('users');
    }
}
