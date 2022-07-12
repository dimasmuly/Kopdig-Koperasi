<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\BusinessDetail;
use App\Models\Cooperative;
use App\Models\Courier;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Rating;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Rating::factory(200)->create();

        /*
        Voucher::insert([
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER1',
                'discount' => 10,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER2',
                'discount' => 20,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER3',
                'discount' => 30,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER4',
                'discount' => 40,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER5',
                'discount' => 50,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER6',
                'discount' => 60,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER7',
                'discount' => 70,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER8',
                'discount' => 80,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER9',
                'discount' => 90,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
            [
                'cooperative_id' => 28,
                'code' => 'VOUCHER10',
                'discount' => 100,
                'effective_date' => '2020-01-01',
                'expired_date' => '2020-12-31',
            ],
        ]);
        */

        // PaymentMethod::insert(
        //     [[
        //         'name' => 'BRI',
        //         'description' => 'BRI',
        //         'thumbnail' => '/images/payment_methods/bri.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'Mandiri',
        //         'description' => 'Mandiri',
        //         'thumbnail' => '/images/payment_methods/mandiri.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'BCA',
        //         'description' => 'BCA',
        //         'thumbnail' => '/images/payment_methods/bca.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'BNI',
        //         'description' => 'BNI',
        //         'thumbnail' => '/images/payment_methods/bni.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'CIMB',
        //         'description' => 'CIMB',
        //         'thumbnail' => '/images/payment_methods/cimb.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'Maybank',
        //         'description' => 'Maybank',
        //         'thumbnail' => '/images/payment_methods/maybank.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'Bank of China',
        //         'description' => 'Bank of China',
        //         'thumbnail' => '/images/payment_methods/bank_of_china.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'Bank of Indonesia',
        //         'description' => 'Bank of Indonesia',
        //         'thumbnail' => '/images/payment_methods/bank_of_indonesia.png',
        //         'credit_number' => '123456789',
        //     ],
        //     [
        //         'name' => 'Bank of Tokyo',
        //         'description' => 'Bank of Tokyo',
        //         'thumbnail' => '/images/payment_methods/bank_of_tokyo.png',
        //         'credit_number' => '123456789',
        //     ],]
        // );

        // // insert multiple data in roles
        // Role::insert([
        //     ['name' => 'Admin'],
        //     ['name' => 'Cooperative Chairman'],
        //     ['name' => 'Member'],
        //     ['name' => 'Guest'],
        //     ['name' => 'Secretary'],
        //     ['name' => 'Treasurer'],
        //     ['name' => 'Vice'],
        // ]);
        // User::factory(40)->create();
        // LoanType::factory(10)->create();
        // Loan::factory(100)->create();
        // Cooperative::factory(40)->create();
        // ProductCategory::factory(10)->create();
        // Product::factory(100)->create();
        // Business::factory(7)->create();
        // BusinessDetail::factory(40)->create();
        // Courier::factory(10)->create();

        // Transaction::create([
        //     'product_id' => 1,
        //     'quantity' => 10,
        //     'destination_address' => 'Jember',
        //     'voucher_id' => 1
        // ]);

        // TransactionDetail::create([
        //     'transaction_id' => 2,
        //     'user_id' => 1,
        //     'courier_id' => 3,
        //     'cooperative_id' => 1,
        //     'total_pay' => 1194069,
        //     'payment_method_id' => 1,
        //     'status' => 'success',
        //     'shipping_fee' => 10000,
        // ]);


    }
}
