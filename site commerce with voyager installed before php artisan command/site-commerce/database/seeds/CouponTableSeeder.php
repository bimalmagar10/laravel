<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
        		'code' => 'ABC123',
        		'type' => 'fixed',
        		'value' => 30

        ]);
         Coupon::create([
        		'code' => 'DEF123',
        		'type' => 'percent',
        		'percent_off' => 50

        ]);
    }
}
