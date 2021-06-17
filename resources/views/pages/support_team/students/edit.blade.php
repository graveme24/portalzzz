@extends('layouts.master')
@section('page_title', 'Edit Student')
@section('content')

        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 id="ajax-title" class="card-title">Please fill The form Below To Edit record of {{ $sr->user->name }}</h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" data-reload="#ajax-title" action="{{ route('students.update', Qs::hash($sr->id)) }}" data-fouc>
                @csrf @method('PUT')
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->name }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option {{ ($sr->user->gender == 'Male' ? 'selected' : '') }} value="Male">Male</option>
                                    <option {{ ($sr->user->gender == 'Female' ? 'selected' : '') }} value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input min="1" type="number" name="age" placeholder="Age" class="form-control" value="{{ $sr->user->age }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->address }}" class="form-control" placeholder="Address" name="address" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email address: <span class="text-danger">*</span></label>
                                <input type="email" value="{{ $sr->user->email }}" name="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone: <span class="text-danger">*</span></label></label>
                                <input value="{{ $sr->user->phone }}" type="text" name="phone" class="form-control" placeholder="" maxlength="11">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="{{ $sr->user->phone2 }}" type="text" name="phone2" class="form-control" placeholder="" maxlength="7">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth: <span class="text-danger">*</span></label>
                                <input name="dob" value="{{ $sr->user->dob }}" type="date" class="form-control date-pick" placeholder="Select Date...">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Place of Birth: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->pob }}" type="text" name="pob" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Religion: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->rel }}" type="text" name="rel" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Citizenship: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->citizenship }}" type="text" name="citizenship" class="form-control" placeholder="">
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
                                <input value="{{ $sr->user->mname }}" required type="text" name="mname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ $sr->user->mage }}" type="text" name="mage" class="form-control" placeholder="" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ $sr->user->moccu }}" type="text" name="moccu" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fathers Name: <span class="text-danger">*</span></label>
                                <input value="{{ $sr->user->fname }}" required type="text" name="fname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ $sr->user->fage }}" type="text" name="fage" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ $sr->user->foccu }}" type="text" name="foccu" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guardians Name:</label>
                                <input value="{{ $sr->user->gname }}" required type="text" name="gname" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Relationship:</label>
                                <input value="{{$sr->user->grel }}" type="text" name="grel" class="form-control" placeholder="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Upload 2x2 Photo:</label>
                                <input value="{{ $sr->user->photo }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
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
                                <label for="mop_id">Mode of Payment<span class="text-danger">*</span></label>
                                <select class="form-control select-search" name="mop_id" id="mop_id">
                                    <option value="">All Types of Payment</option>
                                    @foreach(App\Models\MopTypes::orderBy('id')->get() as $c)
                                        <option {{ old('id') == $c->id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_parent_id">Parent: </label>
                                <select data-placeholder="Choose..."  name="my_parent_id" id="my_parent_id" class="select-search form-control">
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
                    </div>

                </fieldset>

            </form>
        </div>
@endsection
