<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            // City Car (lincah di kota)
            [
                'brand' => 'Honda',
                'name' => 'Honda City',
                'plate_number' => 'B 1001 ABC',
                'year' => 2023,
                'category' => 'City Car (lincah di kota)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 400000,
                'price_12h' => 250000,
                'status' => 'available',
            ],
            [
                'brand' => 'Toyota',
                'name' => 'Toyota Agya',
                'plate_number' => 'B 1002 ABC',
                'year' => 2022,
                'category' => 'City Car (lincah di kota)',
                'seats' => 5,
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'price_24h' => 350000,
                'price_12h' => 220000,
                'status' => 'available',
            ],
            [
                'brand' => 'Daihatsu',
                'name' => 'Daihatsu Ayla',
                'plate_number' => 'B 1003 ABC',
                'year' => 2023,
                'category' => 'City Car (lincah di kota)',
                'seats' => 5,
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'price_24h' => 320000,
                'price_12h' => 200000,
                'status' => 'available',
            ],

            // Sedan (nyaman)
            [
                'brand' => 'Toyota',
                'name' => 'Toyota Corolla',
                'plate_number' => 'B 2001 ABC',
                'year' => 2023,
                'category' => 'Sedan (nyaman)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 600000,
                'price_12h' => 380000,
                'status' => 'available',
            ],
            [
                'brand' => 'Honda',
                'name' => 'Honda Accord',
                'plate_number' => 'B 2002 ABC',
                'year' => 2022,
                'category' => 'Sedan (nyaman)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 750000,
                'price_12h' => 450000,
                'status' => 'available',
            ],
            [
                'brand' => 'Nissan',
                'name' => 'Nissan Teana',
                'plate_number' => 'B 2003 ABC',
                'year' => 2021,
                'category' => 'Sedan (nyaman)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 700000,
                'price_12h' => 420000,
                'status' => 'available',
            ],

            // MPV (keluarga)
            [
                'brand' => 'Toyota',
                'name' => 'Toyota Avanza',
                'plate_number' => 'B 3001 ABC',
                'year' => 2023,
                'category' => 'MPV (keluarga)',
                'seats' => 7,
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'price_24h' => 500000,
                'price_12h' => 310000,
                'status' => 'available',
            ],
            [
                'brand' => 'Daihatsu',
                'name' => 'Daihatsu Xenia',
                'plate_number' => 'B 3002 ABC',
                'year' => 2022,
                'category' => 'MPV (keluarga)',
                'seats' => 7,
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'price_24h' => 480000,
                'price_12h' => 300000,
                'status' => 'available',
            ],
            [
                'brand' => 'Honda',
                'name' => 'Honda CR-V',
                'plate_number' => 'B 3003 ABC',
                'year' => 2023,
                'category' => 'SUV (tangguh/medan berat)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 850000,
                'price_12h' => 520000,
                'status' => 'available',
            ],
            [
                'brand' => 'Toyota',
                'name' => 'Toyota Fortuner',
                'plate_number' => 'B 3004 ABC',
                'year' => 2022,
                'category' => 'SUV (tangguh/medan berat)',
                'seats' => 7,
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'price_24h' => 1000000,
                'price_12h' => 600000,
                'status' => 'available',
            ],

            // Luxury
            [
                'brand' => 'BMW',
                'name' => 'BMW 3 Series',
                'plate_number' => 'B 4001 ABC',
                'year' => 2023,
                'category' => 'Sedan (nyaman)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 1500000,
                'price_12h' => 900000,
                'status' => 'available',
            ],
            [
                'brand' => 'Mercedes-Benz',
                'name' => 'Mercedes C-Class',
                'plate_number' => 'B 4002 ABC',
                'year' => 2023,
                'category' => 'Sedan (nyaman)',
                'seats' => 5,
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'price_24h' => 1800000,
                'price_12h' => 1100000,
                'status' => 'available',
            ],

            // Van / Minibus (dikelompokkan ke MPV)
            [
                'brand' => 'Toyota',
                'name' => 'Toyota Hiace',
                'plate_number' => 'B 5001 ABC',
                'year' => 2022,
                'category' => 'MPV (keluarga)',
                'seats' => 12,
                'transmission' => 'manual',
                'fuel_type' => 'diesel',
                'price_24h' => 900000,
                'price_12h' => 550000,
                'status' => 'available',
            ],
            [
                'brand' => 'Mitsubishi',
                'name' => 'Mitsubishi L300',
                'plate_number' => 'B 5002 ABC',
                'year' => 2021,
                'category' => 'MPV (keluarga)',
                'seats' => 10,
                'transmission' => 'manual',
                'fuel_type' => 'diesel',
                'price_24h' => 800000,
                'price_12h' => 480000,
                'status' => 'available',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
