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
		$sitesCnt = DB::table('sites')->count();
    	for ($i=1; $i <= $sitesCnt; $i++) {
	    	for ($j=1; $j <= 12; $j++) {
	            DB::table('fortunes')->insert([
	            	'site_id' => $i,
	            	'astro_id' => $j,
	                'general' => rand(1,5),
	                'love' => rand(1,5),
	                'job' => rand(1,5),
	                'money' => rand(1,5),
	                'date' => DB::raw('CURRENT_TIMESTAMP'),
	            ]);
	        }
	    }
    }
}
