@foreach($exams as $ex)
    @foreach($exam_records->where('exam_id', $ex->id) as $exr)

        @if(!Qs::userIsTeacher())
            <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="font-weight-bold">{{ $ex->name.' - '.$ex->year }}</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body collapse">
                <table class="table table-bordered table-responsive text-center">
                    <thead>
                    <tr>
                        <th rowspan="2">S/N</th>
                        <th rowspan="2">SUBJECT CODE</th>
                        <th rowspan="2">DESCRIPTION</th>
                        {{-- <th rowspan="2">TEST<br>(40)</th> --}}
                        {{-- <th rowspan="2">GRADE<br>(100)</th> --}}

                        @if($ex->term < 4)
                            <th rowspan="2">FINAL GRADE (100)</th>
                        @endif

                        @if($ex->term == 4) {{-- 4th Term --}}
                        <th rowspan="2">1<sup>ST</sup> <br> TERM</th>
                        <th rowspan="2">2<sup>ND</sup> <br> TERM</th>
                        <th rowspan="2">3<sup>RD</sup> <br> TERM</th>
                        <th rowspan="2">4<sup>TH</sup> <br> TERM</th>
                        <th rowspan="2">TOTAL (400%) <br> 1<sup>ST</sup> + 2<sup>ND</sup> + 3<sup>RD</sup> + 4<sup>TH</sup></th>
                        <th rowspan="2">TOTAL AVE</th>
                        @endif
                        <th rowspan="2">REMARKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $sub)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sub->slug }}</td>
                            <td>{{ $sub->name }}</td>
                            @foreach($marks->where('subject_id', $sub->id)->where('exam_id', $ex->id) as $mk)
                                {{-- <td>{{ $mk->t1 ?: 'N/A' }}</td> --}}
                                {{-- <td>{{ $mk->exm ?: 'N/A' }}</td> --}}

                                @if($ex->term < 4)
                                    @if($ex->term == 1)
                                        <td>{{  $mk->tex1  ?: 'N/A'}}</td>
                                    @elseif ($ex->term == 2)
                                        <td>{{  $mk->tex2  ?: 'N/A'}}</td>
                                    @elseif ($ex->term == 3)
                                        <td>{{  $mk->tex3  ?: 'N/A'}}</td>
                                    @endif
                                @endif


                            {{--4th term Cummulative--}}
                                @if($ex->term == 4)
                                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 1, $mk->my_class_id, $year)  ?: 'N/A' }}</td>
                                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 2, $mk->my_class_id, $year)  ?: 'N/A' }}</td>
                                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 3, $mk->my_class_id, $year)  ?: 'N/A' }}</td>
                                    <td>{{ $mk->tex4 ?: 'N/A' }}</td>
                                    <td>{{ $mk->cum ?: 'N/A' }}</td>
                                    <td>{{ $mk->cum_ave ?: 'N/A' }}</td>
                                @endif
                                <td>{{ $mk->grade ? $mk->grade->remark : 'N/A' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="{{ $ex->term < 4 ? 3 : 6  }}"><strong>TOTAL SCORES OBTAINED: </strong> {{ $exr->total ?: 'N/A'}}</td>
                        <td colspan="{{ $ex->term < 4 ? 3 : 5 }}"><strong>FINAL AVERAGE: </strong> {{ $exr->ave ?: 'N/A'}}</td>
                        {{-- <td colspan="{{ $ex->term < 4 ? 2 : 5 }}"><strong>CLASS AVERAGE: </strong> {{ $exr->class_ave }}</td> --}}
                    </tr>
                    </tbody>
                </table>
                {{--Print Button--}}
                <div class="text-center mt-3">
                    <a target="_blank" href="{{ route('marks.print', [Qs::hash($student_id), $ex->id, $year]) }}" class="btn btn-secondary btn-lg">Print Marksheet <i class="icon-printer ml-2"></i></a>
                </div>
            </div>
        </div>
        @endif

        @if(Qs::userIsTeamSAT())
        {{--    EXAM COMMENTS   --}}
        <div class="card">
            <div class="card-header header-elements-inline bg-dark">
                <h6 class="card-title font-weight-bold">Comments</h6>
                {!! Qs::getPanelOptions() !!}
            </div>

            <div class="card-body collapse">
                <form class="ajax-update" method="post" action="{{ route('marks.comment_update', $exr->id) }}">
                    @csrf @method('PUT')

                    @if(Qs::userIsTeamSAT())
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label font-weight-semibold">Teacher's Comment</label>
                            <div class="col-lg-10">
                                <input name="t_comment" value="{{ $exr->t_comment }}"  type="text" class="form-control" placeholder="Teacher's Comment">
                            </div>
                        </div>
                    @endif

                    @if(Qs::userIsTeamSA())
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label font-weight-semibold">Head Teacher's Comment</label>
                            <div class="col-lg-10">
                                <input name="p_comment" value="{{ $exr->p_comment }}"  type="text" class="form-control" placeholder="Head Teacher's Comment">
                            </div>
                        </div>
                    @endif

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    @endforeach
@endforeach
