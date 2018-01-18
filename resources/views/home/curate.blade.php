@extends('layouts.app')
@section('title', '運勢を横断で見てみよう！')
@section('content')
	<div id="wrap">
		<div class="container">
			<div class="page-header text-center">
				<h3>{{ date('Y年m月d日') . 'の' . $astroName->name . '運勢を横断で見てみよう！' }}</h3>
			</div>
			<div class="row">
@foreach ($fortunes as $fortune)
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading text-center">
						{{ $fortune->name }}
						</div>
						<div class="panel-body">
							<div class="col-md-6">
								<p>総合　{{ str_repeat("★", $fortune->general) }}</p>
								<p>恋愛　{{ str_repeat("★", $fortune->love) }}</p>
								<p>仕事　{{ str_repeat("★", $fortune->job) }}</p>
								<p>お金　{{ str_repeat("★", $fortune->money) }}</p>
							</div>
							<div class="col-md-6">
								<a class="btn btn-primary" href="{{ $fortune->url }}" target="_blank"></a>
							</div>
						</div>
					</div>
				</div>
@endforeach
			</div>
			<div class="panel panel-default">
				<div class="panel-body text-center">
					<a class="btn btn-default"  href="/">星座を選び直す</a>
				</div>
			</div>
		</div>
	</div>
@endsection