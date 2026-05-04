<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Bahasa Indonesia)
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Field :attribute harus diterima.',
    'accepted_if' => 'Field :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Field :attribute bukan URL yang valid.',
    'after' => 'Field :attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => 'Field :attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => 'Field :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Field :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Field :attribute harus berupa array.',
    'before' => 'Field :attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => 'Field :attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'Field :attribute harus berada antara :min dan :max.',
        'file' => 'Field :attribute harus berada antara :min dan :max kilobita.',
        'string' => 'Field :attribute harus berada antara :min dan :max karakter.',
        'array' => 'Field :attribute harus memiliki antara :min dan :max item.',
    ],
    'boolean' => 'Field :attribute harus bernilai benar atau salah.',
    'confirmed' => 'Konfirmasi :attribute tidak sesuai.',
    'current_password' => 'Password tidak benar.',
    'date' => 'Field :attribute bukan tanggal yang valid.',
    'date_equals' => 'Field :attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => 'Field :attribute tidak sesuai dengan format :format.',
    'declined' => 'Field :attribute harus ditolak.',
    'declined_if' => 'Field :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Field :attribute dan :other harus berbeda.',
    'digits' => 'Field :attribute harus berupa angka :digits digit.',
    'digits_between' => 'Field :attribute harus berupa angka antara :min dan :max digit.',
    'dimensions' => 'Field :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Field :attribute memiliki nilai yang duplikat.',
    'email' => 'Field :attribute harus berupa email yang valid.',
    'ends_with' => 'Field :attribute harus diakhiri dengan salah satu dari: :values.',
    'exists' => 'Field :attribute yang dipilih tidak valid.',
    'file' => 'Field :attribute harus berupa file.',
    'filled' => 'Field :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Field :attribute harus lebih besar dari :value.',
        'file' => 'Field :attribute harus lebih besar dari :value kilobita.',
        'string' => 'Field :attribute harus lebih besar dari :value karakter.',
        'array' => 'Field :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Field :attribute harus lebih besar dari atau sama dengan :value.',
        'file' => 'Field :attribute harus lebih besar dari atau sama dengan :value kilobita.',
        'string' => 'Field :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => 'Field :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'Field :attribute harus berupa gambar.',
    'in' => 'Field :attribute yang dipilih tidak valid.',
    'in_array' => 'Field :attribute harus ada dalam :other.',
    'integer' => 'Field :attribute harus berupa bilangan bulat.',
    'ip' => 'Field :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Field :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Field :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Field :attribute harus berupa JSON yang valid.',
    'lt' => [
        'numeric' => 'Field :attribute harus lebih kecil dari :value.',
        'file' => 'Field :attribute harus lebih kecil dari :value kilobita.',
        'string' => 'Field :attribute harus lebih kecil dari :value karakter.',
        'array' => 'Field :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Field :attribute harus lebih kecil dari atau sama dengan :value.',
        'file' => 'Field :attribute harus lebih kecil dari atau sama dengan :value kilobita.',
        'string' => 'Field :attribute harus lebih kecil dari atau sama dengan :value karakter.',
        'array' => 'Field :attribute harus tidak lebih dari :value item.',
    ],
    'max' => [
        'numeric' => 'Field :attribute harus tidak lebih besar dari :max.',
        'file' => 'Field :attribute harus tidak lebih besar dari :max kilobita.',
        'string' => 'Field :attribute harus tidak lebih besar dari :max karakter.',
        'array' => 'Field :attribute harus tidak memiliki lebih dari :max item.',
    ],
    'mimes' => 'Field :attribute harus berupa file bertipe: :values.',
    'mimetypes' => 'Field :attribute harus berupa file bertipe: :values.',
    'min' => [
        'numeric' => 'Field :attribute harus minimal :min.',
        'file' => 'Field :attribute harus minimal :min kilobita.',
        'string' => 'Field :attribute harus minimal :min karakter.',
        'array' => 'Field :attribute harus minimal memiliki :min item.',
    ],
    'multiple_of' => 'Field :attribute harus kelipatan dari :value.',
    'not_in' => 'Field :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'Field :attribute harus berupa angka.',
    'password' => 'Password tidak benar.',
    'present' => 'Field :attribute harus ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Field :attribute wajib diisi.',
    'required_if' => 'Field :attribute wajib diisi ketika :other adalah :value.',
    'required_unless' => 'Field :attribute wajib diisi kecuali :other adalah :values.',
    'required_with' => 'Field :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'Field :attribute wajib diisi ketika :values ada.',
    'required_without' => 'Field :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Field :attribute wajib diisi ketika tidak ada dari :values yang ada.',
    'same' => 'Field :attribute dan :other harus sesuai.',
    'size' => [
        'numeric' => 'Field :attribute harus berukuran :size.',
        'file' => 'Field :attribute harus berukuran :size kilobita.',
        'string' => 'Field :attribute harus berukuran :size karakter.',
        'array' => 'Field :attribute harus berisi :size item.',
    ],
    'starts_with' => 'Field :attribute harus dimulai dengan salah satu dari: :values.',
    'string' => 'Field :attribute harus berupa string.',
    'timezone' => 'Field :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Field :attribute sudah terdaftar.',
    'uploaded' => 'Field :attribute gagal diunggah.',
    'url' => 'Format :attribute tidak valid.',
    'uuid' => 'Field :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute
    | placeholder with something more reader friendly such as "E-Mail Address"
    | instead of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'Nama',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'phone' => 'Nomor Telepon',
        'address' => 'Alamat',
        'city' => 'Kota',
        'province' => 'Provinsi',
        'postal_code' => 'Kode Pos',
        'country' => 'Negara',
        'title' => 'Judul',
        'content' => 'Konten',
        'description' => 'Deskripsi',
        'date' => 'Tanggal',
        'time' => 'Waktu',
        'type' => 'Tipe',
        'status' => 'Status',
    ],

];
