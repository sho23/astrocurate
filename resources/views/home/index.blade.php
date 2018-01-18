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
    </div>
</div>
@endsection