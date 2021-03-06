@extends('layouts.app')
@section('title', '運勢を横断で見てみよう！')
@section('content')
	<div id="wrap">
		<div class="container">
			<div class="page-header">
	            <p class="text-left"><img src="{{ asset('/images/astrocurate_title.png') }}" alt="" width="300"></p>
				<h3 class="text-center">{{ date('Y年m月d日') . 'の' . $astroName->name . 'の運勢を横断で見よう！' }}</h3>
			</div>
			<div class="row animated fadeInUp">
<?php 
	$bgNum = range(0, 10);
	shuffle($bgNum);
?>
@foreach ($fortunes as $key => $fortune)
<?php
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
?>
				<div class="col-md-4 col-sm-{{ $key == 0 ? '12' : '6' }} col-xs-{{ $key == 0 ? '12' : '6' }}">
					<div class="panel panel-warning">
							<div class="panel-heading text-center">
								<h2 class="text-center">{{ $fortune->ranking }}位 <small>( {{ $fortune->name }} )</small></h2>
							</div>
						<div class="panel-body" style="padding:0;">
							@if (false)
								<div class="col-xs-6">
									<p class="text-success">総合<br>{{ str_repeat("★", $fortune->general) }}</p>
									<p class="text-danger">恋愛<br>{{ str_repeat("★", $fortune->love) }}</p>
									<p class="text-primary">仕事<br>{{ str_repeat("★", $fortune->job) }}</p>
									<p class="text-warning">お金<br>{{ str_repeat("★", $fortune->money) }}</p>
								</div>
							@endif
							<a href="{{ $fortune->url . $urlCode }}" target="_blank">
								<div class="col-xs-12" style="padding:0;">
										<img src="{{ asset('/images/bg' . $bgNum[$key] . '-min.JPG') }}" alt="" width="100%">
								</div>
							</a>
						</div>
						<div class="panel-footer text-center">
								<a href="{{ $fortune->url . $urlCode }}" target="_blank">{{ $fortune->name }}で詳しく見る ></a>
						</div>
					</div>
				</div>
@endforeach
			</div>
			<div class="ad-box">
				<!-- admax -->
				<script src="//adm.shinobi.jp/s/9d70a3817ecbd29117bd7b8b9a8e28b8"></script>
				<!-- admax -->
			</div>
			<div class="panel panel-default links">
				<div class="panel-body text-center">
					@foreach ($fortunes as $fortune)
<?php
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
?>
						<a href="{{ $fortune->url . $urlCode }}" class="btn btn-primary" target="_blank">{{ $fortune->name }}</a>
					@endforeach
					<a class="btn btn-default"  href="{{ url('/') }}">星座を選び直す</a>
				</div>
			</div>
		</div>
	</div>
@endsection