@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.access.users.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.active') }}</small>
    </h1>
@endsection

@section('content')



    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.active') }}</h3>
            <!--search form -->
            {!! Form::open(['route' => 'admin.access.users.index','class' => 'form-inline','style' => 'display:inline-block','role' => 'form', 'method' => 'GET']) !!}

                <div class="form-group">
                    {!! Form::text('u_search', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.users.search.search_place')]) !!}
                </div><!--form control-->
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="{{trans('labels.backend.access.users.search.search_button')}}">
                </div>

            {!! Form::close()!!}
            <!-- ./form-->
            <!--save user CSV -->
            {!! Form::open(['route' => 'admin.access.users.csv','class' => 'form-inline','style' => 'display:inline-block','role' => 'form', 'method' => 'POST']) !!}

            <div class="form-group">
                {!! Form::hidden('u_csv', 1) !!}
            </div><!--form control-->
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="{{trans('labels.backend.access.users.csv.csv_button')}}">
            </div>

            {!! Form::close()!!}
            <!-- -->



            <div class="box-tools pull-right">
                @include('backend.access.includes.partials.header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>{{ trans('labels.backend.access.users.table.id') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.name') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.email') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.board') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.confirmed') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.roles') }}</th>
                        <th>{{ trans('labels.backend.access.users.table.other_permissions') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.created') }}</th>
                        <th class="visible-lg">{{ trans('labels.backend.access.users.table.last_updated') }}</th>
                        <th>{{ trans('labels.general.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{!! $user->ID !!}</td>
                                <td>{!! $user->name !!}</td>
                                <td>{!! link_to("mailto:".$user->email, $user->email) !!}</td>
                                <td>{!! $user->board_number !!}</td>
                                <td>{!! $user->confirmed_label !!}</td>
                                <td>
                                    @if ($user->roles()->count() > 0)
                                        @foreach ($user->roles as $role)
                                            {!! $role->name !!}<br/>
                                        @endforeach
                                    @else
                                        {{ trans('labels.general.none') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($user->permissions()->count() > 0)
                                        @foreach ($user->permissions as $perm)
                                            {!! $perm->display_name !!}<br/>
                                        @endforeach
                                    @else
                                        {{ trans('labels.general.none') }}
                                    @endif
                                </td>
                                <td class="visible-lg">{!! $user->created_at->diffForHumans() !!}</td>
                                <td class="visible-lg">{!! $user->updated_at->diffForHumans() !!}</td>
                                <td>{!! $user->action_buttons !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pull-left">
                {!! $users->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $users->total()) }}
            </div>

            <div class="pull-right">
                {!! $users->render() !!}
            </div>

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop