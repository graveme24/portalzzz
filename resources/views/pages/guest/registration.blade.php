@extends('layouts.form')
@section('content')
<div class="container">
        <div class="card content d-flex justify-content-center align-items-center">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">Haven of Wisdom Academy Pre-Registration</h6>
                {!! Qs::getPanelOptions() !!}
            </div>
          <div class="card-body p-4">
              <form method="POST" action="{{ route('guest.create') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="row" style="margin: 10px">
                    <h3>Kindly fill up the form. Especially with the (*).</h3>
                    </div>
                  <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose.." autocomplete="off">
                                    <option value=""></option>
                                    <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                    <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age: <span class="text-danger">*</span></label>
                                <input min="1" type="number" name="age" placeholder="Age" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" value="{{ old('age') }}" autocomplete="off">
                                @if ($errors->has('age'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address: <span class="text-danger">*</span></label>
                                <input value="{{ old('address') }}" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address" name="address" type="text" required autocomplete="off">
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email address: <span class="text-danger">*</span></label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" autocomplete="off" >
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
                                <input value="{{ old('phone') }}" type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="" maxlength="11" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="" maxlength="7" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth: <span class="text-danger">*</span></label>
                                <input name="dob" value="{{ old('dob') }}" type="date" class="form-control date-pick" placeholder="Select Date..." autocomplete="off">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Place of Birth: <span class="text-danger">*</span></label>
                                <input value="{{ old('pob') }}" type="text" name="pob" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Religion: <span class="text-danger">*</span></label>
                                <input value="{{ old('rel') }}" type="text" name="rel" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Citizenship: <span class="text-danger">*</span></label>
                                <input value="{{ old('citizenship') }}" type="text" name="citizenship" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_admitted">Year Admitted: <span class="text-danger">*</span></label>
                                <select data-placeholder="Choose..." required name="year_admitted" id="year_admitted" class="select-search form-control">
                                    <option value=""></option>
                                    @for($y=date('Y', strtotime('- 10 years')); $y<=date('Y'); $y++)
                                        <option {{ (old('year_admitted') == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row" style="margin: 10px">
                        <h3>Kindly fill up the form. Especially with the (*).</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mothers Maiden Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('mname') }}" required type="text" name="mname" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ old('mage') }}" type="text" name="mage" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ old('moccu') }}" type="text" name="moccu" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fathers Name: <span class="text-danger">*</span></label>
                                <input value="{{ old('fname') }}" required type="text" name="fname" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Age:</label>
                                <input value="{{ old('fage') }}" type="text" name="fage" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Occupation:</label>
                                <input value="{{ old('foccu') }}" type="text" name="foccu" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Guardians Name:</label>
                                <input value="{{ old('gname') }}" required type="text" name="gname" class="form-control" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Relationship:</label>
                                <input value="{{ old('grel') }}" type="text" name="grel" class="form-control" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">Intended Grade: <span class="text-danger">*</span></label>
                                <select onchange="getClassSections(this.value)" data-placeholder="Choose..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach(App\Models\MyClass::orderBy('id')->get() as $c)
                                        <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3" style="display: none;">
                            <div class="form-group">
                                <label for="section_id">Section: <span class="text-danger">*</span></label>
                                <select data-placeholder="Select Class First" required name="section_id" id="section_id" class="select-search form-control">
                                    <option {{ (old('section_id')) ? 'selected' : '' }} value="{{ old('section_id') }}">{{ (old('section_id')) ? 'Selected' : '' }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                  <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>
              </form>
          </div>
        </div>
    </div>
</div>
@endsection
