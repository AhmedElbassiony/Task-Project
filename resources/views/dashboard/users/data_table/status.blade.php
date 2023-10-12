@if (!$verified)
    <a style="color: red;" href="{{ route('users.edit', $id) }}"> <span style="width: 100%!important"
            class="badge badge-danger">موقوف </span> </a>
@else
    <a href="{{ route('users.edit', $id) }}"> <span style="width: 100%!important" class="badge badge-success">مفعل</span>
    </a>
@endif
