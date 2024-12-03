<x-mail::message>
# Introduction

Thanks For Subscribe...

<x-mail::button :url="route('frontend.index')">
Visit our website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
