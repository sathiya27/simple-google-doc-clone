@component("mail::message")

# GoodBye, till we meet again {{ $name }} !!, <br>

Thanks for using {{config('app.name')}}.


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