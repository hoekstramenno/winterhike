@component('profiles.activities.activity')
@slot('heading')
{{ $profileUser->name }} replied to a
<a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
@endslot('heading')
@slot('body')
{{ $activity->subject->body }}
@endslot('body')
@endcomponent
