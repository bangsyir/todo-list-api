@component('mail::message')
# you have some reminders to follow up.

The body of your message.

@component('mail::table')
|Reminder|Name|Phone|
|--------|----|-----|
@foreach ($reminders as $reminder)
  |{{$reminder['title']}}|{{$reminder['user']['name']}}|{{$reminder['user']['phone']}}|
@endforeach
@endcomponent

Thanks,<br>
Bangsyir
@endcomponent
