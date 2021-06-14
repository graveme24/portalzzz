{{--<!--NAME , CLASS AND OTHER INFO -->--}}
<table style="width:100%; border-collapse:collapse; ">
    <tbody>
    <tr>
        <td><strong>NAME:</strong> {{ strtoupper($sr->user->name) }}</td>
        <td><strong>ADM NO:</strong> {{ $sr->adm_no }}</td>
        <td><strong>CLASS:</strong> {{ strtoupper($my_class->name) }}</td>
        <td><strong>SECTION:</strong> {{ strtoupper($sr->section->name) }}</td>
    </tr>
    <tr>
        <td><strong>REPORT FOR</strong> {!! strtoupper(Mk::getSuffix($ex->term)) !!} TERM </td>
        <td><strong>ACADEMIC YEAR:</strong> {{ $ex->year }}</td>
        <td><strong>AGE:</strong> {{ $sr->age ?: ($sr->user->dob ? date_diff(date_create($sr->user->dob), date_create('now'))->y : '-') }}</td>
    </tr>

    </tbody>
</table>


{{--Exam Table--}}
<table style="width:100%; border-collapse:collapse; border: 1px solid #000; margin: 10px auto;" border="1">
    <thead>
    <tr>
        <th rowspan="2">S/N</th>
        <th rowspan="2">SUBJECT CODE</th>
        <th rowspan="2">DESCRIPTION</th>

        @if($ex->term < 4) {{-- 1st, 2nd & 3rd Term--}}
        <th rowspan="2">FINAL GRADE</th>
        {{-- <th rowspan="2">SUBJECT <br> POSITION</th> --}}
        @endif

        @if($ex->term == 4) {{-- 4th Term --}}
        <th rowspan="2">1<sup>ST</sup> TERM</th>
        <th rowspan="2">2<sup>ND</sup> TERM</th>
        <th rowspan="2">3<sup>RD</sup> TERM</th>
        <th rowspan="2">4<sup>TH</sup> TERM</th>
        <th rowspan="2">TOTAL (400%) <br> 1<sup>ST</sup> + 2<sup>ND</sup> + 3<sup>RD</sup> + 4<sup>TH</th>
        <th rowspan="2">TOTAL AVE</th>
        @endif

        <th rowspan="2">REMARKS</th>
    </tr>
    {{-- <tr>
        <th>CA1(10)</th>
        <th>MID(20)</th>
        <th>CA2(10)</th>
        <th>TOTAL(40)</th>
    </tr> --}}
    </thead>
    <tbody>
    @foreach($subjects as $sub)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="font-weight: bold">{{ $sub->slug }}</td>
            <td style="font-weight: bold">{{ $sub->name }}</td>
            @foreach($marks->where('subject_id', $sub->id)->where('exam_id', $ex->id) as $mk)
                {{-- <td>{{ $mk->t1 ?: 'N/A' }}</td>
                <td>{{ $mk->t2 ?: 'N/A' }}</td>
                <td>{{ $mk->t3 ?: 'N/A' }}</td>
                <td>{{ $mk->tca ?: '-' }}</td>
                <td>{{ $mk->exm ?: 'N/A' }}</td> --}}

                @if($ex->term < 4)
                    @if($ex->term == 1)
                        <td>{{  $mk->tex1  ?: 'N/A'}}</td>
                    @elseif ($ex->term == 2)
                        <td>{{  $mk->tex2  ?: 'N/A'}}</td>
                    @elseif ($ex->term == 3)
                        <td>{{  $mk->tex3  ?: 'N/A'}}</td>
                    @endif
                    {{-- <td>{!! ($mk->grade) ? Mk::getSuffix($mk->sub_pos) : 'N/A' !!}</td> --}}
                    <td>{{ $mk->grade ? $mk->grade->remark : 'N/A' }}</td>
                @endif

                @if($ex->term == 4)
                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 1, $mk->my_class_id, $year) ?: 'N/A'}}</td>
                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 2, $mk->my_class_id, $year) ?: 'N/A'}}</td>
                    <td>{{ Mk::getSubTotalTerm($student_id, $sub->id, 3, $mk->my_class_id, $year) ?: 'N/A'}}</td>
                    <td>{{ $mk->tex4 ?: 'N/A' }}</td>
                    <td>{{ $mk->cum ?: 'N/A' }}</td>
                    <td>{{ $mk->cum_ave ?: 'N/A' }}</td>
                    {{-- <td>{{ $mk->grade ? $mk->grade->name : '-' }}</td> --}}
                    <td>{{ $mk->grade ? $mk->grade->remark : 'N/A' }}</td>
                @endif

            @endforeach
        </tr>
    @endforeach
    <tr>
        <td colspan="{{ $ex->term < 4 ? 5 : 6 }}"><strong>TOTAL SCORES OBTAINED: </strong> {{ $exr->total ?: 'N/A'}}</td>
        <td colspan="{{ $ex->term < 4 ? 5 : 7 }}"><strong>FINAL AVERAGE: </strong> {{ $exr->ave ?: 'N/A'}}</td>
        {{-- <td colspan="{{ $ex->term < 4 ? 3 : 3 }}"><strong>CLASS AVERAGE: </strong> {{ $exr->class_ave ?: 'N/A'}}</td> --}}
    </tr>
    </tbody>
</table>

{{--Key to Grading--}}
<div style="margin-bottom: 5px; text-align: center">
    <table border="0" cellpadding="5" cellspacing="5" style="text-align: center; margin: 0 auto;">
        <tr>
            <td><strong>KEY TO THE GRADING</strong></td>
        @if(Mk::getGradeList($class_type->id)->count())
           @foreach(Mk::getGradeList($class_type->id) as $gr)
            <td><strong>{{ $gr->name }}</strong>
                => {{ $gr->mark_from.' - '.$gr->mark_to }}
            </td>
            @endforeach
            @endif
        </tr>
    </table>

</div>




{{--    COMMENTS & SIGNATURE    --}}
<div style="margin-top: 10px; clear: both;"></div>
<div style="margin-top:15px;">
    <table class="td-left" style="border-collapse:collapse;">
        <tbody>
        <tr>
            <td><strong>CLASS TEACHER'S COMMENT:</strong></td>
            <td>  {{ $exr->t_comment }}</td>
        </tr>
        <tr>
            <td><strong>PRINCIPAL'S COMMENT:</strong></td>
            <td>  {{ $exr->p_comment }}</td>
        </tr>
        <tr>
            <td><strong>NEXT TERM BEGINS:</strong></td>
            <td>{{ date('l\, jS F\, Y', strtotime($s['term_begins'])) }}</td>
        </tr>
        <tr>
            <td><strong>NEXT TERM FEES:</strong></td>
            <td>Php </del>{{ $s['next_term_fees_'.strtolower($ct)] }}</td>
        </tr>
        </tbody>
    </table>
    </div>
