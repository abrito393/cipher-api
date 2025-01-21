<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $currencies = [
            ['name' => 'US Dollar', 'symbol' => '$', 'exchange_rate' => 1.00],
            ['name' => 'Euro', 'symbol' => '€', 'exchange_rate' => 0.85],
            ['name' => 'British Pound', 'symbol' => '£', 'exchange_rate' => 0.75],
            ['name' => 'Japanese Yen', 'symbol' => '¥', 'exchange_rate' => 110.00],
            ['name' => 'Canadian Dollar', 'symbol' => 'C$', 'exchange_rate' => 1.25],
            ['name' => 'Mexican Peso', 'symbol' => 'MX$', 'exchange_rate' => 20.00],
        ];

        DB::table('currencies')->insert($currencies);
    }
}
