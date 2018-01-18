@extends('layouts.app')
@section('title', '運勢を横断で見てみよう！')
@section('content')
<div id="wrap">
    <div class="container">
        <div class="page-header text-center">
            <h3>運勢を横断で見てみよう！</h3>
        </div>
        <?php $astro = []; ?>
        <form class="form-horizontal col-md-8 col-md-offset-2" action="curate" method="post">
            <div class="form-group">
                <label for="astro" class="control-label col-xs-4">星座を選択してください</label>
                <div class="col-xs-5">
                    <select class="form-control" name="astro">
                        <?php
                        $astro = ['おひつじ座', 'おうし座', 'ふふたご座', 'かに座', 'しし座', 'おとめ座', 'てんびん座', 'さそり座', 'いて座', 'やぎ座', 'みずがめ座', 'うお座'];
                        foreach ($astro as $key => $value) {
                            $key = $key+1;
                            echo '<option value="', $key, '">', $value, '</option>';
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
        <a href="https://fortune.yahoo.co.jp/12astro/<?php echo $astro[0]?>"></a>
    </div>
</div>
@endsection