@extends('layouts.master')
@section('page_title', 'Student Payments')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title"><i class="icon-cash2 mr-2"></i> Student Payments</h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">


            <form method="post" action="{{ route('payments.select_class') }}">
                @csrf

              <div class="row">
                  <div class="col-md-6 offset-md-3">
                      <div class="row">
                          <div class="col-md-10">
                              <div class="form-group">
                                  <label for="my_class_id" class="col-form-label font-weight-bold">Class:</label>
                                  <select required id="my_class_id" name="my_class_id" class="form-control select">
                                      <option value="">Select Class</option>
                                      @foreach(App\Models\MyClass::orderBy('id')->get() as $c)
                                          <option {{ ($selected && $my_class_id == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-2 mt-4">
                              <div class="text-right mt-1">
                                  <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>

            </form>
        </div>
    </div>
    @if($selected)

        <div class="card-body" style="background: white; background-color: #fff; background-clip: border-box; border: 1px solid rgba(0, 0, 0, .125); border-radius: .1875rem;">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-cash" class="nav-link active" data-toggle="tab">Cash</a></li>
                <li class="nav-item"><a href="#all-quarter" class="nav-link" data-toggle="tab">Quarterly</a></li>
                <li class="nav-item"><a href="#all-six" class="nav-link" data-toggle="tab">6 Months</a></li>
                <li class="nav-item"><a href="#all-ten" class="nav-link" data-toggle="tab">10 Months</a></li>
            </ul>

            <div class="tab-content">
            <div class="tab-pane fade show active" id="all-cash">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Mode of Payment</th>
                        <th>ADM_No</th>
                        <th>Payments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cash as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$s->user->avatar) }}" alt="photo"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->mop->name }}</td>
                            <td>{{ $s->adm_no }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class=" btn btn-danger" data-toggle="dropdown"> Manage Payments <i class="icon-arrow-down5"></i>
                                    </a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a href="{{ route('payments.invoice', [Qs::hash($s->user_id)]) }}" class="dropdown-item">All Payments</a>
                                @foreach(Pay::getYears($s->user_id) as $py)
                                @if($py)
                                    <a href="{{ route('payments.invoice', [Qs::hash($s->user_id), $py]) }}" class="dropdown-item">{{ $py }}</a>
                                @endif
                                @endforeach
                            </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="all-quarter">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Mode of Payment</th>
                        <th>ADM_No</th>
                        <th>Payments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quarter as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$s->user->avatar) }}" alt="photo"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->mop->name }}</td>
                            <td>{{ $s->adm_no }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class=" btn btn-danger" data-toggle="dropdown"> Manage Payments <i class="icon-arrow-down5"></i>
                                    </a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a href="{{ route('payments.invoice', [Qs::hash($s->user_id)]) }}" class="dropdown-item">All Payments</a>
                                @foreach(Pay::getYears($s->user_id) as $py)
                                @if($py)
                                    <a href="{{ route('payments.invoice', [Qs::hash($s->user_id), $py]) }}" class="dropdown-item">{{ $py }}</a>
                                @endif
                                @endforeach
                            </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="all-six">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Mode of Payment</th>
                        <th>ADM_No</th>
                        <th>Payments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($six as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$s->user->avatar) }}" alt="photo"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->mop->name }}</td>
                            <td>{{ $s->adm_no }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class=" btn btn-danger" data-toggle="dropdown"> Manage Payments <i class="icon-arrow-down5"></i>
                                    </a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a href="{{ route('payments.invoice', [Qs::hash($s->user_id)]) }}" class="dropdown-item">All Payments</a>
                                @foreach(Pay::getYears($s->user_id) as $py)
                                @if($py)
                                    <a href="{{ route('payments.invoice', [Qs::hash($s->user_id), $py]) }}" class="dropdown-item">{{ $py }}</a>
                                @endif
                                @endforeach
                            </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="all-ten">
                <table class="table datatable-button-html5-columns">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Mode of Payment</th>
                        <th>ADM_No</th>
                        <th>Payments</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ten as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ asset('/storage/'.config('chatify.user_avatar.folder').'/'.$s->user->avatar) }}" alt="photo"></td>
                            <td>{{ $s->user->name }}</td>
                            <td>{{ $s->mop->name }}</td>
                            <td>{{ $s->adm_no }}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class=" btn btn-danger" data-toggle="dropdown"> Manage Payments <i class="icon-arrow-down5"></i>
                                    </a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a href="{{ route('payments.invoice', [Qs::hash($s->user_id)]) }}" class="dropdown-item">All Payments</a>
                                @foreach(Pay::getYears($s->user_id) as $py)
                                @if($py)
                                    <a href="{{ route('payments.invoice', [Qs::hash($s->user_id), $py]) }}" class="dropdown-item">{{ $py }}</a>
                                @endif
                                @endforeach
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
    @endif
@endsection
