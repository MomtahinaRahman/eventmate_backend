@component('mail::message')

Sign Up Here {{ $name }}

@component('mail::button', ['url' => 'https://www.google.com/'])
  Click Here
@endcomponent

@endcomponent