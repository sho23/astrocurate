<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use \App\User;

class HomeController extends Controller
{
	public function index()
	{
		return view('home.index');
	}

	public function curate(Request $request)
	{
		$astroId = $request->astro;
		if (!isset($astroId)) {
			return redirect('home/index');
		}
		$fortunes = DB::table('fortunes')
				->where('astro_id', $astroId)
				->where('date', date('Y-m-d'))
				->orderBy('site_id')
				->join('sites', 'sites.id', '=', 'fortunes.site_id')
				->select('fortunes.*', 'sites.name', 'sites.url')
				->get();
		$astroName = DB::table('astros')
				->where('id', $astroId)
				->select('astros.name')
				->first();
		return view('home.curate', ['fortunes' => $fortunes, 'astroName' => $astroName]);
	}
}
