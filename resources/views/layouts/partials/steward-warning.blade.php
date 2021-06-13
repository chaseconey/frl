@if(auth()->user() && auth()->user()->can('manage-protests') && \App\Models\Protest::inReview()->count() > 0)
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <x-alert-warning>
            <strong>Steward Notification</strong>
            <span>There are <a class="underline" href="/nova/resources/protests?protests_filter=W3siY2xhc3MiOiJBcHBcXE5vdmFcXEZpbHRlcnNcXFByb3Rlc3RTdGF0dXMiLCJ2YWx1ZSI6ImluLXJldmlldyJ9XQ%3D%3D">un-resolved protests</a> to review.</span>
        </x-alert-warning>
    </div>
@endif
