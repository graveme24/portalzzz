@extends('layouts.master')
@section('page_title', 'Admit Student')
@section('content')
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">Please fill The form Below To Admit A New Student</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('students.store') }}" data-fouc>
               @csrf
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input min="1" type="number" name="age" placeholder="Age" class="form-control" value="{{ old('age') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address: <span class="text-danger">*</span></label>
                                <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email address: <span class="text-danger">*</span></label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone: <span class="text-danger">*</span></label></label>
                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+63" maxlength="11" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="" maxlength="7">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth: <span class="text-danger">*</span></label>
                                <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="mm/dd/yyyy" >

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Place of Birth: <span class="text-danger">*</span></label>
                                <input value="{{ old('pob') }}" type="text" name="pob" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Religion: <span class="text-danger">*</span></label>
                                <input value="{{ old('rel') }}" type="text" name="rel" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Citizenship: <span class="text-danger">*</span></label>
                                <input value="{{ old('citizenship') }}" type="text" name="citizenship" class="form-control" placeholder="">
                            </div>
                        </div>

                    </div>
                    <div class="row" style="margin: 10px">
                        <h3>Kindly fill up the form. Especially with the (*).</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mothers Maiden Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('mname') }}" required type="text" name="mname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ old('mage') }}" type="text" name="mage" class="form-control" placeholder="" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ old('moccu') }}" type="text" name="moccu" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fathers Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('fname') }}" required type="text" name="fname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ old('fage') }}" type="text" name="fage" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ old('foccu') }}" type="text" name="foccu" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guardians Name:</label>
                                <input value="{{ old('gname') }}" required type="text" name="gname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Relationship:</label>
                                <input value="{{ old('grel') }}" type="text" name="grel" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Upload 2x2 Photo:</label>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <h6>Student Data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">Class: <span class="text-danger">*</span></label>
                                <select onchange="getClassSections(this.value)" data-placeholder="Choose..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach(App\Models\MyClass::orderBy('id')->get() as $c)
                                        <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                </select>
                        </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id">Section: <span class="text-danger">*</span></label>
                                <select data-placeholder="Select Class First" required name="section_id" id="section_id" class="select-search form-control">
                                    <option {{ (old('section_id')) ? 'selected' : '' }} value="{{ old('section_id') }}">{{ (old('section_id')) ? 'Selected' : '' }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_parent_id">Parent: </label>
                                <select data-placeholder="Choose..." name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                    <option  value=""></option>
                                    @foreach($parents as $p)
                                        <option {{ (old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_admitted">Year Admitted: <span class="text-danger">*</span></label>
                                <select data-placeholder="Choose..." required name="year_admitted" id="year_admitted" class="select-search form-control">
                                    <option value=""></option>
                                    @for($y=date('Y', strtotime('- 10 years')); $y<=date('Y'); $y++)
                                        <option {{ (old('year_admitted') == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mop_id">Mode of Payment<span class="text-danger">*</span></label>
                                <select class="form-control select-search" name="mop_id" id="mop_id">
                                    <option value="">All Types of Payment</option>
                                    @foreach(App\Models\MopTypes::orderBy('id')->get() as $c)
                                        <option {{ old('id') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- <div class="col-md-3">
                            <label for="dorm_id">Dormitory: </label>
                            <select data-placeholder="Choose..."  name="dorm_id" id="dorm_id" class="select-search form-control">
                                <option value=""></option>
                                @foreach($dorms as $d)
                                    <option {{ (old('dorm_id') == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                            </select>

                        </div> --}}

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Dormitory Room No:</label>
                                <input type="text" name="dorm_room_no" placeholder="Dormitory Room No" class="form-control" value="{{ old('dorm_room_no') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sport House:</label>
                                <input type="text" name="house" placeholder="Sport House" class="form-control" value="{{ old('house') }}">
                            </div>
                        </div> --}}


                    </div>
                </fieldset>

            </form>
        </div>
    @endsection
