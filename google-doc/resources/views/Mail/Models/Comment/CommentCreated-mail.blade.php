@component("mail::message")
Hey {{$username}},
new comment has been added in post {{$post_name}}, 
{{config('app.name')}}.


@component('mail::panel')

@component('mail::button', ['url' => 'http://youtube.com'])
See Post
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