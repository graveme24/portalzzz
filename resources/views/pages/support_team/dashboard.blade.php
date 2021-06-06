@extends('layouts.master')
@section('page_title', 'My Dashboard')
@section('content')
    @if(Qs::userIsTeamSA())
       <div class="row">
           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-blue-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'student')->count() }}</h3>
                           <span class="text-uppercase font-size-xs font-weight-bold">Total Students</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users4 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-danger-400 has-bg-image">
                   <div class="media">
                       <div class="media-body">
                           <h3 class="mb-0">{{ $users->where('user_type', 'teacher')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Teachers</span>
                       </div>

                       <div class="ml-3 align-self-center">
                           <i class="icon-users2 icon-3x opacity-75"></i>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-success-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-pointer icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'admin')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Administrators</span>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-sm-6 col-xl-3">
               <div class="card card-body bg-indigo-400 has-bg-image">
                   <div class="media">
                       <div class="mr-3 align-self-center">
                           <i class="icon-user icon-3x opacity-75"></i>
                       </div>

                       <div class="media-body text-right">
                           <h3 class="mb-0">{{ $users->where('user_type', 'parent')->count() }}</h3>
                           <span class="text-uppercase font-size-xs">Total Parents</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       @endif
    {{-- @if(Qs::userIsStudent())
    <div class="container">
        <div class="card content d-flex justify-content-center align-items-center">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">Haven of Wisdom Academy Pre-Registration</h6>
                {!! Qs::getPanelOptions() !!}
            </div>
          <div class="card-body p-4">
              <form method="POST" action="{{ route('student.upload') }}" enctype="multipart/form-data">
                  @csrf
                  <fieldset>
                    <div class="row" style="margin: 10px">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Upload BirthCertificate:</label>
                                <span class="form-text text-muted">Remarks: <input type="text" disabled style="margin: 12px;"></span>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="bc" class="form-input-styled" data-fouc>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Upload Form 137(Previous Card):</label>
                                <span class="form-text text-muted">Remarks: <input type="text" disabled style="margin: 12px;"></span>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="formg" class="form-input-styled" data-fouc>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="d-block">Upload Good Moral:</label>
                                <span class="form-text text-muted">Remarks: <input type="text" disabled style="margin: 12px;"></span>
                                <input value="{{ old('photo') }}" accept="image/*" type="file" name="goodm" class="form-input-styled" data-fouc>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="col-md-2">
                    <button class="btn btn-block btn-primary" type="submit">{{ __('Upload') }}</button>
                </div>
              </form>
          </div>
        </div>
    </div>
</div>
    @endif --}}

    {{--Events Calendar Begins--}}
    {{-- <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">School Events Calendar</h5>
         {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div id='calendar'></div>
        </div>

    </div> --}}
    {{--Events Calendar Ends--}}
    @endsection

