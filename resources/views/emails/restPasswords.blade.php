<x-mail::message>

    # Introduction

    Dear User,
    <br>
    Click This Link Below to Complete Password Reset Process.
    <br>
    <a href="{{ route('password.reset.form', $token) }}" class="btn btn-primary">Reset Password Link</a>
    <br>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
