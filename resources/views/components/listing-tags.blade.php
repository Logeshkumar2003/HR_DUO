@props(['tags'])

@php
$tagsExplode = explode(',', $tags ?? '');
@endphp

@foreach($tagsExplode as $tag)
    @if(trim($tag) != '')
        <a href="/jobs?tag={{ urlencode(trim($tag)) }}" class="tag-badge"><i class="fa fa-tag"></i> {{ trim($tag) }}</a>
    @endif
@endforeach
