<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'name' => 'Yahoo占い',
			'url' => 'https://fortune.yahoo.co.jp/12astro/'
        ]);

        DB::table('sites')->insert([
            'name' => 'VOGUE',
			'url' => 'https://www.vogue.co.jp/horoscope/daily/'
        ]);

        DB::table('sites')->insert([
            'name' => 'So-net',
			'url' => 'https://www.so-net.ne.jp/fortunes/today/DispConstel.cgi?constellation='
        ]);

        DB::table('sites')->insert([
            'name' => 'nifty',
			'url' => 'https://uranai.nifty.com/f12seiza/'
        ]);

        DB::table('sites')->insert([
            'name' => 'au占い',
			'url' => 'https://fortune.auone.jp/astro/result/?astro_code='
        ]);

        DB::table('sites')->insert([
            'name' => 'ELLE',
			'url' => 'http://www.elle.co.jp/horoscope/daily/(star)/'
        ]);

        DB::table('sites')->insert([
            'name' => 'Docomo',
			'url' => 'http://service.smt.docomo.ne.jp/portal/fortune/src/fortune_'
        ]);

        DB::table('sites')->insert([
            'name' => 'メ〜テレ',
			'url' => 'https://www.nagoyatv.com/horoscope/detail.html?hs_code='
        ]);

        DB::table('sites')->insert([
            'name' => 'eo占い',
			'url' => 'http://eonet.jp/fortune/constellation/result.php?conste='
        ]);

        DB::table('sites')->insert([
            'name' => 'FIGARO',
			'url' => 'https://madamefigaro.jp/fortune/horoscope/'
        ]);
    }
}