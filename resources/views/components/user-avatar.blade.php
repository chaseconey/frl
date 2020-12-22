@if($user && $user->email)
<img class="h-10 w-10 rounded-full"
     src="{{ Gravatar::src($user->email) }}"
     alt="{{ $user->name }}">
@else
    <img class="h-10 w-10 rounded-full"
         src="https://via.placeholder.com/150"
         alt="Anon">
@endif
