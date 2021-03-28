@if(auth()->user()->can('manage-protests') && \App\Models\Protest::inReview()->count() > 0)
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <x-alert-warning>
            <strong>Steward Notification</strong>
            <span>There are <a class="underline" href="/nova/resources/protests">un-resolved protests</a> to review.</span>
        </x-alert-warning>
    </div>
@endif
