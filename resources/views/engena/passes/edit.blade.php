@extends('backend.layouts.master')
@section ('title', trans('labels.engena.passes.edit'))

@section('page-header')
    <h1>{{ trans('labels.engena.passes.edit') }}</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            {!! $editForm !!}
        </div>
    </div>
@endsection
