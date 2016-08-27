@extends('backend.layouts.master')
@section ('title', trans('labels.engena.trails.all'))

@section('page-header')
    <h1>
        {{ trans('labels.engena.trails.all') }}
        <a href="{{ route('admin.trails.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> {{ trans('labels.engena.trails.add') }}
        </a>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            <div class="table-responsive">
                {!! $dataGrid !!}
            </div>
        </div>
    </div>
@endsection
