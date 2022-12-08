<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lokasi;
use Faker\Generator as Faker;

$factory->define(Lokasi::class, function (Faker $faker) {
    return [
        'nama_lokasi' => $faker->nama,
        'alamat_lokasi' => $faker->alamat
    ];
});
