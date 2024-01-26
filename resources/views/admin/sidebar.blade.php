<div class="col-3">
    <ul class="list-group">
        <a href="{{ route('admin.classroom') }}" class="list-group-item {{ request()->is('admin/class/*') ? 'active' : '' }} ">Classes</a>
        <a href="{{ route('admin.teachers') }}" class="list-group-item {{ request()->is('admin/teacher/*') ? 'active' : '' }}" >Teachers</a>
        <a href="{{ route('admin.students') }}" class="list-group-item {{ request()->is('admin/student/*') ? 'active' : '' }}">Students</a>
        <a href="{{ route('admin.courses') }}" class="list-group-item {{ request()->is('admin/courses/*') ? 'active' : '' }}">Courses</a>
    </ul>
</div>
