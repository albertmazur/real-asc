@component('mail::message')
# {{ __('app.contact.email_subject') }}

**{{ __('app.contact.form.name_label') }}:** {{ $data['name'] }}  
**{{ __('app.contact.form.email_label') }}:** {{ $data['email'] }}  

---
{{ $data['message'] }}

{{ __('app.contact.signature') }},<br>
{{ config('app.name') }}
@endcomponent
