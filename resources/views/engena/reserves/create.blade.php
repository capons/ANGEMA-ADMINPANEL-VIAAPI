@extends('backend.layouts.master')
@section ('title', trans('labels.engena.reserves.create'))

@section('page-header')
    <h1>{{ trans('labels.engena.reserves.create') }}</h1>
@endsection

@section('content')
    {!! Html::style('css/vendor/select2/select2.min.css') !!}
    {!! Html::style('css/vendor/select2/select2-bootstrap.min.css') !!}
    <div class="box box-success">
        <div class="box-body">
            <div id="app">
                @include('engena.reserves.partials.modal')

                {!! $dataForm->header !!}
                    {!! $dataForm->body !!}
                    @include('engena.reserves.partials.passes')
                {!! $dataForm->footer !!}
            </div>
        </div>
    </div>
    {!! Html::script('js/engena/app.js') !!}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#activities').select2({theme: "bootstrap"});
        });
    </script>
@endsection
