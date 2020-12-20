@if($track->avatar)
    <img class="h-10 w-10 rounded-full"
         src="/storage/{{ $track->avatar }}"
         alt="{{ $track->name }}">
@else
    <img class="h-10 w-10 rounded-full"
         src="https://via.placeholder.com/150"
         alt="{{ $track->name }}">
@endif
