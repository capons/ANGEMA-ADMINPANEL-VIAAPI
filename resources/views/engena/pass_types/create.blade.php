@extends('backend.layouts.master')
@section ('title', trans('labels.engena.passTypes.create'))

@section('page-header')
    <h1>{{ trans('labels.engena.passTypes.create') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            {!! $dataForm !!}
        </div>
    </div>
@endsection
