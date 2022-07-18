@component('mail::message')
# Hi,

New Ticket has been created.

Author name- {{ $ticket->author_name }}

Title - {{ $ticket->title }}

Decription - {{ $ticket->content }}

@component('mail::button', ['url' => config('app.url').'/tickets/'.$ticket->id])
View Ticket
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent