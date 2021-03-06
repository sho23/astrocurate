<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use DB;

class GetElmController extends Controller
{
    public function getRankings()
    {
    	// $this->getYahoo();
    	// $this->getVogue();
    	/* so-net　ランキングないため無視 */
    	// $this->getGoo();
    	// $this->getNifty();
    	// $this->getAu();

    	/* jsで要素取得できず */
    	// $this->getElle();

    	// $this->getDocomo();
    	// $this->getMTV();
    	// $this->getEo();
    	// $this->getFigaro();
    	exit();
    }

    public function getYahoo()
    {
		$client = new Client();
		$crawler = $client->request('GET', "https://fortune.yahoo.co.jp/12astro/ranking.html");
		$astroRanks = [];
		$astroRanks = $crawler->filter('#rank .seiza')->each(function($element){
			return $element->filter('img')->eq(0)->attr('alt');
		});
		$astroIdList = [];
		foreach ($astroRanks as $key => $astroRank) {
			$astroId = null;
			$astroId = DB::table('astros')
					->select('astros.id')
					->where('name', $astroRank)
					->first();
			$astroIdList[] = $astroId;
		}
    	$urlCodes = $this->getUrlCodes(1);
		foreach ($astroIdList as $key => $astroId) {
			$ranking = $key + 1;
			DB::table('fortunes')->insert(
			    ['site_id' => 1, 'astro_id' => $astroId->id, 'ranking' => $ranking, 'url_code' => $urlCodes[$astroId->id -1],'date' => date('Y-m-d')]
			);
		}
    }

    public function getGoo()
    {
		$client = new Client();
    	$urlCodes = $this->getUrlCodes(1);
    	foreach ($urlCodes as $key => $urlCode) {
			$astroId = $key + 1;
			$crawler = $client->request('GET', "https://fortune.goo.ne.jp/destiny/" . $urlCode . ".html");
			$alt = $crawler->filter('.titlef')->filter('img')->eq(1)->attr('alt');
			$rank = preg_replace('/[^0-9]/', '', $alt);
			DB::table('fortunes')->insert(
			    ['site_id' => 11, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
			);
    	}
    }

  //   public function getElle()
  //   {
		// $client = new Client();
  //   	$urlCodes = $this->getUrlCodes(1);
  //   	foreach ($urlCodes as $key => $urlCode) {
		// 	$astroId = $key + 1;
		// 	$crawler = $client->request('GET', "http://www.elle.co.jp/horoscope/daily/(star)/" . $urlCode);
		// 	$rank = $crawler->filter('#rrank1')->html();
		// 	var_dump($rank);
		// 	exit();
		// 	// $rank = preg_replace('/[^0-9]/', '', $alt);
		// 	// DB::table('fortunes')->insert(
		// 	//     ['site_id' => 6, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
		// 	// );
  //   	}
  //   }

    public function getVogue()
    {
		$client = new Client();
    	$urlCodes = $this->getUrlCodes(1);
    	foreach ($urlCodes as $key => $urlCode) {
			$astroId = $key + 1;
			$crawler = $client->request('GET', "https://www.vogue.co.jp/horoscope/daily/" . date("Y/n/j/") . $urlCode);
			$text = $crawler->filter('.horoscope__single__header__content__no')->text();
			$rank = preg_replace('/[^0-9]/', '', $text);
			DB::table('fortunes')->insert(
			    ['site_id' => 2, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
			);
    	}
    }

    public function getNifty()
    {
		$client = new Client();
    	$urlCodes = $this->getUrlCodes(3);
    	foreach ($urlCodes as $key => $urlCode) {
			$astroId = $key + 1;
			$crawler = $client->request('GET', "https://uranai.nifty.com/f12seiza/" . $urlCode . "/");
			$alt = $crawler->filter('.obi-brown')->filter('h2')->text();
			$rankElm = explode(" ", $alt);
			$rank = preg_replace('/[^0-9]/', '', $rankElm[4]);
			DB::table('fortunes')->insert(
			    ['site_id' => 4, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
			);
    	}
    }

    public function getAu()
    {
		$client = new Client();
		$crawler = $client->request('GET', "https://fortune.auone.jp/astro/");
		$astroRanks = [];
		$astroRanks = $crawler->filter('.ft-mainbox__stars_img')->each(function($element){
			return $element->filter('img')->eq(0)->attr('alt');
		});
		$astroIdList = [];
		foreach ($astroRanks as $key => $astroRank) {
			$astroId = null;
			$astroId = DB::table('astros')
					->select('astros.id')
					->where('name', $astroRank)
					->first();
			$astroIdList[] = $astroId;
		}
    	$urlCodes = $this->getUrlCodes(4);
		foreach ($astroIdList as $key => $astroId) {
			$ranking = $key + 1;
			DB::table('fortunes')->insert(
			    ['site_id' => 5, 'astro_id' => $astroId->id, 'ranking' => $ranking, 'url_code' => $urlCodes[$astroId->id -1],'date' => date('Y-m-d')]
			);
		}
    }

    public function getDocomo()
    {
		$client = new Client();
    	$urlCodes = $this->getUrlCodes(4);
    	foreach ($urlCodes as $key => $urlCode) {
			$astroId = $key + 1;
			$crawler = $client->request('GET', "http://service.smt.docomo.ne.jp/portal/fortune/src/fortune_" . sprintf('%02d', $urlCode) . ".html");
			$text = $crawler->filter('.val')->eq(0)->filter('p')->text();
			$rank = preg_replace('/[^0-9]/', '', $text);
			DB::table('fortunes')->insert(
			    ['site_id' => 7, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
			);
    	}
    }

    public function getMTV()
    {
		$client = new Client();
    	$urlCodes = $this->getUrlCodes(4);
    	foreach ($urlCodes as $key => $urlCode) {
			$astroId = $key + 1;
			$crawler = $client->request('GET', "https://www.nagoyatv.com/horoscope/detail.html?hs_code=" . $urlCode);
			$alt = $crawler->filter('#specArea')->filter('img')->eq(0)->attr('alt');
			$rank = preg_replace('/[^0-9]/', '', $alt);
			DB::table('fortunes')->insert(
			    ['site_id' => 8, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
			);
    	}
    }

    public function getEo()
    {
		$client = new Client();
		$crawler = $client->request('GET', "http://eonet.jp/fortune/constellation/");
		$astroRanks = [];
		$astroRanks = $crawler->filter('.rank-unit')->filter('.rank-ttl')->each(function($element){
			$text = $element->text();
			$rank = explode("：", $text);
			return $rank[1];
		});
		$astroIdList = [];
		foreach ($astroRanks as $key => $astroRank) {
			$astroId = null;
			$astroId = DB::table('astros')
					->select('astros.id')
					->where('name', $astroRank)
					->first();
			$astroIdList[] = $astroId;
		}
    	$urlCodes = $this->getUrlCodes(1);
		foreach ($astroIdList as $key => $astroId) {
			$ranking = $key + 1;
			DB::table('fortunes')->insert(
			    ['site_id' => 9, 'astro_id' => $astroId->id, 'ranking' => $ranking, 'url_code' => $urlCodes[$astroId->id -1],'date' => date('Y-m-d')]
			);
		}
    }

    public function getFigaro()
    {
		$client = new Client();
		$crawler = $client->request('GET', "https://madamefigaro.jp/fortune/horoscope/");
		$astroRanks = [];
		$astroRanks = $crawler->filter('.dailyRankList .blcTxt')->each(function($element){
			return $element->filter('.ttl')->text();
		});
		$astroIdList = [];
		foreach ($astroRanks as $key => $astroRank) {
			$astroId = null;
			$astroId = DB::table('astros')
					->select('astros.id')
					->where('name', $astroRank)
					->first();
			$astroIdList[] = $astroId;
		}
    	$urlCodes = $this->getUrlCodes(1);
		foreach ($astroIdList as $key => $astroId) {
			$ranking = $key + 1;
			DB::table('fortunes')->insert(
			    ['site_id' => 10	, 'astro_id' => $astroId->id, 'ranking' => $ranking, 'url_code' => $urlCodes[$astroId->id -1],'date' => date('Y-m-d')]
			);
		}
    }

    private function getUrlCodes($type)
    {
    	if ($type == 1) {
			$urlCodes = ['aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'capricorn', 'aquarius', 'pisces'];
		} elseif ($type == 2) {
			$urlCodes = ['HO01', 'HO02', 'HO03', 'HO04', 'HO05', 'HO06', 'HO07', 'HO08', 'HO09', 'HO10', 'HO11', 'HO12'];
		} elseif ($type == 3) {
			$urlCodes = ['ohitsuji', 'oushi', 'hutago', 'kani', 'shishi', 'otome', 'tenbin', 'sasori', 'ite', 'yagi', 'mizugame', 'uo'];
		} elseif ($type == 4) {
			$urlCodes = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
		}
		return $urlCodes;
    }
}
