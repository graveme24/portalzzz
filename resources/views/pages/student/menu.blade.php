{{--Marksheet--}}

<li class="nav-item">
    <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.show', 'marks.year_selector', 'pins.enter']) ? 'active' : '' }}">
        <i class="icon-books"></i>
        <span>Enrolled Subjects</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('marks.year_select', Qs::hash(Auth::user()->id)) }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.show', 'marks.year_selector', 'pins.enter']) ? 'active' : '' }}">
        <i class="icon-book"></i>
        <span>My Grades</span>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('student.balances', Qs::hash(Auth::user()->id)) }}"  class="nav-link">
        <i class="icon-coins"></i>
        <span>Balances / Promissory</span>
    </a>
</li>



