@component("mail::message")

# Welcome {{ $name }} !!, <br>
Registered Email: {{ $email }}

Thanks, <br>
Special {{config('app.name')}}.


@component('mail::panel')

@component('mail::button', ['url' => 'http://youtube.com'])
Button Text
@endcomponent

@endcomponent

@component('mail::table')
    | Name      | Email             | Role  |
    | --------- | ----------------- | ----- |
    | John Doe  | john@example.com  | Admin |
    | Jane Doe  | jane@example.com  | User  |
@endcomponent

@component('mail::subcopy')
This is a subcopy component
@endcomponent

@endcomponent