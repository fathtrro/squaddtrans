<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display services page
     */
    public function index()
    {
        $services = [
            [
                'id' => 1,
                'title' => 'Sewa + Driver',
                'slug' => 'sewa-driver',
                'description' => 'Manfaat perjalanan tanpa risik dengan pengemudi profesional dan berpengalaman.',
                'icon' => 'person_pin_circle',
                'color' => 'yellow',
                'badge' => 'Most Popular',
                'features' => [
                    'Driver Berlisensi',
                    'Termasuk BBM & Parkir',
                    'On-Time Guarantee',
                    'Asuransi Perjalanan'
                ],
                'price' => [
                    'amount' => 600000,
                    'unit' => '12 jam',
                    'display' => 'Rp 600.000'
                ]
            ],
            [
                'id' => 2,
                'title' => 'Sewa Lepas Kunci',
                'slug' => 'sewa-lepas-kunci',
                'description' => 'Kebebasan penuh berkendara sendiri dengan kendaraan unit. Hebat dan prima.',
                'icon' => 'key',
                'color' => 'blue',
                'badge' => 'Premium',
                'features' => [
                    'Durasi 24 Jam Penuh',
                    'Asuransi All-Risk',
                    'Unit Steril & Wangi',
                    'Unit Tahun > 2022',
                    'Bantuan 24/7'
                ],
                'price' => [
                    'amount' => 350000,
                    'unit' => 'hari',
                    'display' => 'Rp 350.000'
                ]
            ],
            [
                'id' => 3,
                'title' => 'Antar Jemput Bandara',
                'slug' => 'airport-transfer',
                'description' => 'Layanan kenyamanan untuk perjalanan atau penerbangan ke bandara internasional.',
                'icon' => 'flight_takeoff',
                'color' => 'purple',
                'badge' => null,
                'features' => [
                    'Pick up Tepat Waktu',
                    'Tracking Real-time',
                    'Harga Tetap',
                    'Meet & Greet Service'
                ],
                'price' => [
                    'amount' => 450000,
                    'unit' => 'trip',
                    'display' => 'Rp 450.000'
                ]
            ],
            [
                'id' => 4,
                'title' => 'City Tour/Paket Wisata',
                'slug' => 'city-tour',
                'description' => 'Dapatkan destinasi terbaik dengan layanan lengkap kami untuk keluarga eksklusif.',
                'icon' => 'map',
                'color' => 'green',
                'badge' => null,
                'features' => [
                    'Itinerary Custom',
                    'Dokumentasi Gratis',
                    'Tiket Objek Wisata',
                    'Guide Wisata'
                ],
                'price' => [
                    'amount' => 1200000,
                    'unit' => 'paket',
                    'display' => 'Rp 1.200.000'
                ]
            ]
        ];

        return view('services.index', compact('services'));
    }

    /**
     * Display service detail by slug
     */
    public function show($slug)
    {
        $serviceDetails = [
            'sewa-lepas-kunci' => [
                'title' => 'Sewa Lepas Kunci',
                'slug' => 'sewa-lepas-kunci',
                'icon' => 'key',
                'description' => 'Nikmati kebebasan berkendara sepenuhnya dengan layanan Sewa Lepas Kunci dari Squad Trans. Sangat cocok untuk Anda yang menginginkan privasi dan fleksibilitas selama perjalanan.',
                'image' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800',
                'features' => [
                    [
                        'icon' => 'verified_user',
                        'title' => 'Asuransi All-Risk',
                        'description' => 'Perlindungan menyeluruh untuk keamanan perjalanan Anda'
                    ],
                    [
                        'icon' => 'support_agent',
                        'title' => 'Bantuan 24/7',
                        'description' => 'Tim support siap membantu kapan saja Anda membutuhkan'
                    ],
                    [
                        'icon' => 'new_releases',
                        'title' => 'Tahun Unit > 2022',
                        'description' => 'Armada terbaru dengan teknologi modern'
                    ],
                    [
                        'icon' => 'cleaning_services',
                        'title' => 'Unit Higienis',
                        'description' => 'Dibersihkan dan disterilkan setiap sebelum penyewaan'
                    ]
                ],
                'requirements' => [
                    'Memiliki SIM A yang masih aktif dan KTP asli untuk verifikasi data.',
                    'Bersedia dituliskan survey untuk penyewaan pertama kali.',
                    'Penyewa wajib isi bahan bakar untuk sisa yang disediakan.'
                ],
                'pricing' => [
                    'daily' => 350000,
                    'weekly' => 2100000,
                    'monthly' => 7500000
                ],
                'includes' => [
                    'Durasi rental 24 jam penuh',
                    'Asuransi All-Risk',
                    'Gratis antar-jemput unit (area tertentu)',
                    'Unit bersih dan wangi',
                    'Emergency support 24/7'
                ]
            ],
            'sewa-driver' => [
                'title' => 'Sewa + Driver',
                'slug' => 'sewa-driver',
                'icon' => 'person_pin_circle',
                'description' => 'Perjalanan tanpa khawatir dengan driver profesional kami yang berpengalaman dan ramah.',
                'image' => 'https://images.unsplash.com/photo-1464746133101-a2c3f88e0dd9?w=800',
                'features' => [
                    [
                        'icon' => 'badge',
                        'title' => 'Driver Bersertifikat',
                        'description' => 'Driver profesional dengan pengalaman minimal 5 tahun'
                    ],
                    [
                        'icon' => 'local_gas_station',
                        'title' => 'Bebas Biaya BBM',
                        'description' => 'Sudah termasuk biaya bahan bakar'
                    ],
                    [
                        'icon' => 'verified_user',
                        'title' => 'Asuransi Perjalanan',
                        'description' => 'Perlindungan asuransi untuk penumpang'
                    ],
                    [
                        'icon' => 'schedule',
                        'title' => 'On-Time Guarantee',
                        'description' => 'Garansi ketepatan waktu penjemputan'
                    ]
                ],
                'requirements' => [
                    'Melakukan booking minimal 24 jam sebelum keberangkatan.',
                    'Memberikan detail perjalanan dan tujuan.',
                    'Mematuhi peraturan perjalanan yang berlaku.'
                ],
                'pricing' => [
                    'halfday' => 600000,
                    'fullday' => 1000000,
                    'overtime' => 100000
                ],
                'includes' => [
                    'Driver profesional berpengalaman',
                    'Biaya BBM dan parkir',
                    'Durasi 12 jam (half day) atau 24 jam (full day)',
                    'Asuransi perjalanan',
                    'Gratis air mineral'
                ]
            ]
        ];

        $service = $serviceDetails[$slug] ?? abort(404);

        return view('services.show', compact('service'));
    }
}
