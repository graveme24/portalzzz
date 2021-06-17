@extends('layouts.master')
@section('page_title', 'My Balances')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-bold">{{$sr->user->name}} </h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="nav-item"><a href="#all-uc" class="nav-link active" data-toggle="tab">Uncompleted Payments</a></li>
                    <li class="nav-item"><a href="#all-cl" class="nav-link" data-toggle="tab">Completed Payments</a></li>
                    <li class="nav-item"><a href="#all-pn" class="nav-link" data-toggle="tab">Prosmissory Note</a></li>
                </ul>

        <div class="tab-content">

            <div class="tab-pane fade show active" id="all-uc">
                <table class="table datatable-button-html5-columns table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Pay_Ref</th>
                        <th>Amount</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Receipt_No</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($uncleared as $uc)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $uc->payment->title }}</td>
                            <td>{{ $uc->payment->ref_no }}</td>

                            {{--Amount--}}
                            <td class="font-weight-bold" id="amt-{{ Qs::hash($uc->id) }}" data-amount="{{ $uc->payment->amount }}">{{ $uc->payment->amount }}</td>

                            {{--Amount Paid--}}
                            <td id="amt_paid-{{ Qs::hash($uc->id) }}" data-amount="{{ $uc->amt_paid ?: 0 }}" class="text-blue font-weight-bold">{{ $uc->amt_paid ?: '0.00' }}</td>

                            {{--Balance--}}
                            <td id="bal-{{ Qs::hash($uc->id) }}" class="text-danger font-weight-bold">{{ $uc->balance ?: $uc->payment->amount }}</td>


                            {{--Receipt No--}}
                            <td>{{ $uc->ref_no }}</td>

                            <td>{{ $uc->year }}</td>

                            {{--Action--}}
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">
                                            {{--Receipt--}}
                                                <a target="_blank" href="{{ route('payments.receipts', Qs::hash($uc->id)) }}" class="dropdown-item"><i class="icon-printer"></i> Print Receipt</a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="all-cl">
                <table class="table datatable-button-html5-columns table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Pay_Ref</th>
                        <th>Amount</th>
                        <th>Receipt_No</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cleared as $cl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cl->payment->title }}</td>
                            <td>{{ $cl->payment->ref_no }}</td>

                            {{--Amount--}}
                            <td class="font-weight-bold">{{ $cl->payment->amount }}</td>
                            {{--Receipt No--}}
                            <td>{{ $cl->ref_no }}</td>

                            <td>{{ $cl->year }}</td>

                            {{--Action--}}
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-left">


                                            {{--Receipt--}}
                                            <a target="_blank" href="{{ route('payments.receipts', Qs::hash($cl->id)) }}" class="dropdown-item"><i class="icon-printer"></i> Print Receipt</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="all-pn">
                <div class="card content d-flex justify-content-center align-items-center">
                    <div class="card-header bg-white header-elements-inline">
                        <h6 class="card-title">Haven of Wisdom Academy Promissory Application</h6>

                    </div>
                    <form method="POST" action="{{ route('guest.create') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="row" style="margin: 20px">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Quarter: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="quarter" name="quarter" required data-fouc data-placeholder="Choose.." autocomplete="off">
                                            <option value=""></option>
                                            @foreach(App\Models\Quarterly::orderBy('id')->get() as $c)
                                            <option {{ (old('id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block">Upload your letter of promissory note:</label>
                                        <input value="{{ old('photo') }}" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" type="file" name="promissory_file" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Accepting files: docs, txt. Max file size 2Mb</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row" style="margin-left: 50px">
                            <div class="col-md-3" style="margin-top: 25px">
                                <button class="btn btn-block btn-success" type="submit">{{ __('Upload') }}</button>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status of Approval:</label>
                                    <input value="{{ old('fname') }}" required type="text" name="statusa" class="form-control" autocomplete="off" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{--Payments Invoice List Ends--}}

@endsection
