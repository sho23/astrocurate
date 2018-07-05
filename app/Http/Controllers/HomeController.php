<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use \App\User;

class HomeController extends Controller
{
	public function index()
	{
		$astros = DB::table('astros')
				->orderBy('id', 'asc')
				->get();
		return view('home.index', ['astros' => $astros]);
	}

	public function curate(Request $request)
	{
		$astroId = $request->astro_id;
		if (!isset($astroId)) {
			return redirect('home/index');
		}
		$fortunes = DB::table('fortunes')
				->where('astro_id', $astroId)
				->where('date', date('Y-m-d'))
				->join('sites', 'sites.id', '=', 'fortunes.site_id')
				->select('fortunes.*', 'sites.name', 'sites.url', 'sites.id')
				->orderBy('ranking', 'asc')
				->get();

		$astroName = DB::table('astros')
				->where('id', $astroId)
				->select('astros.name')
				->first();
		return view('home.curate', ['fortunes' => $fortunes, 'astroName' => $astroName]);
	}

    public function bestRank(Request $request)
    {
    	$astroId = $request->input('astroId');
		if (empty($astroId)) return;

        $text = [];
        $fortune = DB::table('fortunes')
                ->where('date', date('Y-m-d'))
                ->where('astro_id', $astroId)
                ->join('sites', 'sites.id', '=', 'fortunes.site_id')
                ->select('fortunes.ranking', 'fortunes.site_id', 'fortunes.url_code', 'fortunes.date', 'sites.name', 'sites.url')
                ->orderBy('ranking', 'asc')
                ->first();
        $text['ranking'] = $fortune->ranking;
        $text['name'] = $fortune->name;

		$urlCode = $fortune->url_code;
		if ($fortune->site_id == 2) {
			$urlCode = date("Y/n/j/") . $fortune->url_code;
		} elseif ($fortune->site_id == 4) {
			$urlCode = $fortune->url_code . '/';
		} elseif ($fortune->site_id == 7) {
			$urlCode = sprintf('%02d', $fortune->url_code) . '.html';
		} elseif ($fortune->site_id == 11) {
			$urlCode = $fortune->url_code . '.html';
		}

        $text['url'] = $fortune->url . $urlCode;
        return json_encode($text);
    }

}
