@extends('backend.layouts.master')
@section ('title', trans('labels.engena.passDurations.edit'))

@section('page-header')
    <h1>{{ trans('labels.engena.passDurations.edit') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            {!! $dataForm !!}
        </div>
    </div>
@endsection
