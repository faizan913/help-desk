@component('mail::message')
# Hi,

Author name- {{ $ticket->author_name }}

Title - {{ $ticket->title }}

Decription - {{ $ticket->content }}

@component('mail::button', ['url' => config('app.url').'/tickets/'.$ticket->id])
View Ticket
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
