<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            [
                'key' => 'meta.name',
                'value' => 'SopiCMS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'meta.title',
                'value' => 'SopiCMS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'meta.description',
                'value' => 'Opis strony',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'meta.keywords',
                'value' => 'słowa, kluczowe, strony',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'meta.index',
                'value' => 'all',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'socialmedia.facebook',
                'value' => 'https://facebook.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'socialmedia.instagram',
                'value' => 'https://instagram.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'socialmedia.youtube',
                'value' => 'https://youtube.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'socialmedia.twitter',
                'value' => 'https://twitter.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'socialmedia.linkedin',
                'value' => 'https://linkedin.com',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'email.to',
                'value' => 'admin@serwer-wh.h2g.pl',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'email.reply',
                'value' => 'admin@serwer-wh.h2g.pl',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'email.sender',
                'value' => 'SopiCMS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'ads.block1',
                'value' => '<div style="padding: 60px 30px; border: 2px dashed #ccc; text-align: center; color: #aaa;">Miejsce na Twoją reklamę<br><a href="./kontakt" style="color: #aaa; text-decoration: underline;">Współpraca</a></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'ads.block2',
                'value' => '<div style="padding: 60px 30px; border: 2px dashed #ccc; text-align: center; color: #aaa;">Miejsce na Twoją reklamę<br><a href="./kontakt" style="color: #aaa; text-decoration: underline;">Współpraca</a></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'ads.block3',
                'value' => '<div style="padding: 60px 30px; border: 2px dashed #ccc; text-align: center; color: #aaa;">Miejsce na Twoją reklamę<br><a href="./kontakt" style="color: #aaa; text-decoration: underline;">Współpraca</a></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'ads.block4',
                'value' => '<div style="padding: 60px 30px; border: 2px dashed #ccc; text-align: center; color: #aaa;">Miejsce na Twoją reklamę<br><a href="./kontakt" style="color: #aaa; text-decoration: underline;">Współpraca</a></div>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'other.head',
                'value' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'key' => 'other.body',
                'value' => '',
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
        Schema::dropIfExists('settings');
    }
}
