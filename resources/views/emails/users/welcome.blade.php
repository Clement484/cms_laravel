<x-mail::message>
  # Welcome, {{ $user->name }} 🎉

  We’re excited to have you on board. There are a few things you can explore:
  Click the button below to log in and get started.

<x-mail::button :url="route('login')">
  Log In
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
