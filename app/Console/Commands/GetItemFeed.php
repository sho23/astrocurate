<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Goutte\Client;
use DB;

class GetItemFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getitem';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getYahoo();
        $this->getVogue();
        /* so-net　ランキングないため無視 */
        $this->getGoo();
        $this->getNifty();
        $this->getAu();

        /* jsで要素取得できず */
        // $this->getElle();

        $this->getDocomo();
        $this->getMTV();
        $this->getEo();
        $this->getFigaro();
    }

    public function getYahoo()
    {
        if ($this->checkData(1)) {
            return;
        }
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
        if ($this->checkData(11)) {
            return;
        }
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
  //    $urlCodes = $this->getUrlCodes(1);
  //    foreach ($urlCodes as $key => $urlCode) {
        //  $astroId = $key + 1;
        //  $crawler = $client->request('GET', "http://www.elle.co.jp/horoscope/daily/(star)/" . $urlCode);
        //  $rank = $crawler->filter('#rrank1')->html();
        //  var_dump($rank);
        //  exit();
        //  // $rank = preg_replace('/[^0-9]/', '', $alt);
        //  // DB::table('fortunes')->insert(
        //  //     ['site_id' => 6, 'astro_id' => $astroId, 'ranking' => $rank, 'url_code' => $urlCode,'date' => date('Y-m-d')]
        //  // );
  //    }
  //   }

    public function getVogue()
    {
        if ($this->checkData(2)) {
            return;
        } elseif (strtotime(date("Y/m/d") . '02:04:30') > strtotime(date("Y/m/d H:i:s"))) {
            Log::info('Update after 2AM　Date:' . date('Y-m-d H:i:s'));
            return;
        }
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
        if ($this->checkData(4)) {
            return;
        }
        $client = new Client();
        $urlCodes = $this->getUrlCodes(3);
        foreach ($urlCodes as $key => $urlCode) {
            $astroId = $key + 1;
            $crawler = $client->request('GET', "https://uranai.nifty.com/f12seiza/" . $urlCode . '/' . date('Ymd') . '/');
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
        if ($this->checkData(5)) {
            return;
        }
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
        if ($this->checkData(7)) {
            return;
        }
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
        if ($this->checkData(8)) {
            return;
        }
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
        if ($this->checkData(9)) {
            return;
        }
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
        if ($this->checkData(10)) {
            return;
        } elseif (strtotime(date("Y/m/d") . '00:05:00') > strtotime(date("Y/m/d H:i:s"))) {
            return;
        }
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
                ['site_id' => 10    , 'astro_id' => $astroId->id, 'ranking' => $ranking, 'url_code' => $urlCodes[$astroId->id -1],'date' => date('Y-m-d')]
            );
        }
    }

    private function checkData($site_id)
    {
        $fortunes = DB::table('fortunes')
        ->where('date', date('Y-m-d'))
        ->where('site_id', $site_id)
        ->first();
        if (count($fortunes) > 0) {
            Log::info('Updated site_id=' . $site_id . ' Date:' . date('Y-m-d H:i:s'));
            return true;
        }
        return false;
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
