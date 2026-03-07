<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipVezbeSeeder extends Seeder
{
    public function run(): void
    {
        $vezbe = [
            // Leđa
            ['id' => 3,  'inkrement' => 4], // Lat pulldown
            ['id' => 4,  'inkrement' => 0.00], // zgib - bodyweight
            ['id' => 19, 'inkrement' => 2.50], // dumbell row
            ['id' => 20, 'inkrement' => 10.00], // Deadlift
            ['id' => 31, 'inkrement' => 5], // wide grip row
            ['id' => 33, 'inkrement' => 10.00], // mrtvo dizanje

            // Grudi
            ['id' => 5,  'inkrement' => 2.5], // ravan bench sa bucicama
            ['id' => 9,  'inkrement' => 2.50], // hammer incline press
            ['id' => 10, 'inkrement' => 2.50], // kosi bench sa bucicama
            ['id' => 14, 'inkrement' => 2.50], // ravan bench machine
            ['id' => 15, 'inkrement' => 5], // machine fly
            ['id' => 16, 'inkrement' => 2.50], // ravna masina benc
            ['id' => 21, 'inkrement' => 2.50], // dumbell flat press
            ['id' => 23, 'inkrement' => 5], // Bench press
            ['id' => 24, 'inkrement' => 1.25], // fly sa bucicama
            ['id' => 25, 'inkrement' => 2.50], // incline machine press

            // Ramena
            ['id' => 11, 'inkrement' => 2.50], // shoulder press
            ['id' => 12, 'inkrement' => 0.25], // Lateral raise
            ['id' => 13, 'inkrement' => 0.25], // cable lateral raise

            // Noge
            ['id' => 26, 'inkrement' => 5], // calf raise
            ['id' => 27, 'inkrement' => 5], // leg extension

            // Stomak
            ['id' => 6,  'inkrement' => 0], // leg raise

            // Biceps
            ['id' => 32, 'inkrement' => 1.25], // preacher curl
        ];

        foreach ($vezbe as $vezba) {
            DB::table('tip_vezbe')
                ->where('id', $vezba['id'])
                ->update(['inkrement' => $vezba['inkrement']]);
        }
    }
}