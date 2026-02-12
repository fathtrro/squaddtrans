<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'bank_name' => 'BCA',
                'account_number' => '1234567890',
                'account_holder_name' => 'PT. SQUADTRANS',
                'is_active' => true,
            ],
            [
                'bank_name' => 'Mandiri',
                'account_number' => '0987654321',
                'account_holder_name' => 'PT. SQUADTRANS',
                'is_active' => true,
            ],
            [
                'bank_name' => 'BRI',
                'account_number' => '5678901234',
                'account_holder_name' => 'PT. SQUADTRANS',
                'is_active' => true,
            ],
            [
                'bank_name' => 'BNI',
                'account_number' => '4321098765',
                'account_holder_name' => 'PT. SQUADTRANS',
                'is_active' => true,
            ],
        ];

        foreach ($banks as $bank) {
            BankAccount::firstOrCreate(
                ['account_number' => $bank['account_number']],
                $bank
            );
        }
    }
}

