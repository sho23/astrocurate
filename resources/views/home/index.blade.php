@extends('layouts.app')
@section('title', '運勢を横断で見てみよう！')
@section('content')
<div id="wrap">
    <div class="container">
        <div class="page-header">
            <p class="text-left"><img src="{{ asset('/images/astrocurate_title.png') }}" alt="" width="300"></p>
            <h3 class="text-center">運勢を横断で見てみよう！</h3>
        </div>
        @if (false)
        <?php $astro = []; ?>
            <form class="form-horizontal col-md-8 col-md-offset-2" action="curate" method="post">
                <div class="form-group">
                    <label for="astro" class="control-label col-xs-4">星座を選択してください</label>
                    <div class="col-xs-5">
                        <select class="form-control" name="astro">
                            <?php
                            foreach ($astros as $key => $value) {
                                echo '<option value="', $key+1, '">', $value, '</option>';
                            }
                            ?>
                        </select>
                    </div>
                     <div class="col-xs-3">
                        <button type="submit" class="btn btn-primary">キュレート！</button>
                     </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </div>
            </form>
        @endif
        <div class="row astrolist">
            @foreach ($astros as $astro)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <a href="{{ url('/curate', ['astro_id' => $astro->id]) }}">
                        <div class="panel panel-warning text-center">
                            <div class="panel-heading text-center">
                                <h2 class="text-center">{{ $astro->name }}  <small>{{ $astro->period }}</small></h2>
                            </div>
                            <div class="panel-body">
                                <img src="{{ asset('/images/' . $astro->en_name . '.png') }}" alt="" width="100">
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection