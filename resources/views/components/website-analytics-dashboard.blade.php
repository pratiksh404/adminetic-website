<div>
    {{-- MODAL COUNT --}}
    @include('website::admin.layouts.modules.dashboard.model_count.dashboard')

    {{-- GOOGLE ANALYTICS --}}
    @include('website::admin.layouts.modules.dashboard.google_analytics.dashboard')

    {{-- POST --}}
    @include('website::admin.layouts.modules.dashboard.post.dashboard')

    {{-- SCRIPTS --}}
    @section('custom_js')
    {{-- GOOGLE ANALYTICS --}}
    @include('website::admin.layouts.modules.dashboard.google_analytics.scripts')
    {{-- POST --}}
    @include('website::admin.layouts.modules.dashboard.post.scripts')
    @endsection
</div>