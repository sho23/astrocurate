<?php

use Illuminate\Database\Seeder;

class AstrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $astros = [
            ['おひつじ座', '3/21～4/19'],
            ['おひつじ座', '4/20～5/20'],
            ['ふたご座', '5/21～6/21'],
            ['かに座', '6/22～7/22'],
            ['しし座', '7/23～8/22'],
            ['おとめ座', '8/23～9/22'],
            ['てんびん座', '9/23～10/23'],
            ['さそり座', '10/24～11/21'],
            ['いて座', '11/22～12/21'],
            ['やぎ座', '12/22～1/19'],
            ['みずがめ座', '1/20～2/18'],
            ['うお座', '2/19～3/20']
        ];
        foreach ($astros as $astro) {
            DB::table('astros')->insert([
                'name' => $astro[0],
                'period' => $astro[1],
            ]);
        }
    }
}
