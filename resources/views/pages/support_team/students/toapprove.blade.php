@extends('layouts.master')
@section('page_title', 'Pending Students')
@section('content')

<div class="card">
    <div class="card-header header-elements-inline">
        <h6 class="card-title">Pending Students</h6>
        {!! Qs::getPanelOptions() !!}
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-highlight">
            <li class="nav-item"><a href="#all-students" class="nav-link active" data-toggle="tab">Pending Students</a></li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Select Class</a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach($my_classes as $c)
                    <a href="#c{{ $c->id }}" class="dropdown-item" data-toggle="tab">{{ $c->name }}</a>
                    @endforeach
                </div>
            </li> --}}
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="all-students">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Intended Class</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($not as $s)
                    <tr>

                        <td>{{ $s->id }}</td>
                        <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$s->user->avatar) }}" alt="photo"></td>
                        <td>{{ $s->user->name }}</td>
                        <td>{{ $s->adm_no }}</td>
                        <td>{{ $s->my_class->name.' '.$s->section->name }}</td>
                        <td>
                            @if ($s->status == '1')
                                Active
                            @elseif ($s->status == '0')
                                Pending
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left">
                                        <a href="{{ route('students.show', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                        @if(Qs::userIsTeamSA())
                                        {{-- <a href="{{ route('students.addclass', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a> --}}
                                        <a href="{{ route('approve', Qs::hash($s->user->id)) }}" class="dropdown-item"><i class="icon-check"></i> Activate</a>
                                        {{-- <a class="dropdown-item"><i class="icon-check"></i><input data-id="{{$s->user->id}}" class="toggle-class dropdown-item" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $s->user->status ? 'checked' : '' }}></a> --}}
                                        @endif
                                        @if(Qs::userIsSuperAdmin())
                                        <a id="{{ Qs::hash($s->user->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                        <form method="post" id="item-delete-{{ Qs::hash($s->user->id) }}" action="{{ route('students.destroy', Qs::hash($s->user->id)) }}" class="hidden">@csrf @method('delete')</form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

{{--Student List Ends--}}

@endsection
