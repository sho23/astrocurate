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
}
