<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentGatewayBD;

class PaymentGatewayBDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentGatewayBD::updateOrCreate([
            'gateway'       => 'Aamarpay',
            'store_id'      => 'aamarpay',
            'signature_key' => '28c78bb1f45112f5d40b956fe104645a',
            'status'        => 0
        ]);

        PaymentGatewayBD::updateOrCreate([
            'gateway'       => 'ShurjoPay',
            'store_id'      => 'shurjopay',
            'signature_key' => '28c78bb1f45112f5d40b956fe104645a',
            'status'        => 0
        ]);

        PaymentGatewayBD::updateOrCreate([
            'gateway'       => 'SSLCommerz',
            'store_id'      => 'sslcommerz',
            'signature_key' => '28c78bb1f45112f5d40b956fe104645a',
            'status'        => 0
        ]);
    }
}
