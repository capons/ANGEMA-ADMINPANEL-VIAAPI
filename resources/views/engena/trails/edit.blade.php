@extends('backend.layouts.master')
@section ('title', trans('labels.engena.trails.edit'))
<!-- <link href="/css/vendor/bootstrap-fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" /> -->

@section('page-header')
    <h1>{{ trans('labels.engena.trails.edit') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            {!! $dataForm !!}
        </div>
    </div>
@endsection
