@extends('backend.layouts.master')
@section ('title', trans('labels.engena.passes.all'))

@section('page-header')
    <h1>
        {{ trans('labels.engena.passes.all') }}
        <a href="{{ route('admin.passes.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> {{ trans('menus.engena.passes.add') }}
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
