@component('mail::message')
# Reset Account

Welcome body {{ $data['data']->name}}

@component('mail::button', ['url' => aurl('rest/password/'.$data['token'])])
Click Here To Reset Your Password
@endcomponent
Or copy this Link <br>
<a href="{{ aurl('rest/password/'.$data['token']) }}">{{aurl('rest/password/'.$data['token'])}}</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
