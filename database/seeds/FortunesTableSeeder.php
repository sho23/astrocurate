<?php

use Illuminate\Database\Seeder;

class FortunesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$astroLinks = [
			['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'],
			['HO01', 'HO02', 'HO03', 'HO04', 'HO05', 'HO06', 'HO07', 'HO08', 'HO09', 'HO10', 'HO11', 'HO12'],
			['ohitsuji', 'oushi', 'hutago', 'kani', 'shishi', 'otome', 'tenbin', 'sasori', 'ite', 'yagi', 'mizugame', 'uo'],
			['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
		];
		$sitesCnt = DB::table('sites')->count();
    	for ($i=1; $i <= $sitesCnt; $i++) {
			if (in_array($i, [1,2,6,9,10,11])) {
				$type = 0;
			} elseif ($i == 3) {
				$type = 1;
			} elseif ($i == 4) {
				$type = 2;
			} elseif (in_array($i, [5,7,8])) {
				$type = 3;
			}
	    	for ($j=1; $j <= 12; $j++) {
	            DB::table('fortunes')->insert([
	            	'site_id' => $i,
	            	'astro_id' => $j,
	                'general' => rand(1,5),
	                'love' => rand(1,5),
	                'job' => rand(1,5),
	                'money' => rand(1,5),
	                'ranking' => rand(1,12),
	                'url_code' => $astroLinks[$type][$j-1],
	                'date' => DB::raw('CURRENT_TIMESTAMP'),
	            ]);
	        }
	    }
    }
}