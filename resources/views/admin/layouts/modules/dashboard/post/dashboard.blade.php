@if (config('website.post_dashboard_active',false))
{{-- CHARTS --}}
@include('website::admin.layouts.modules.dashboard.post.monthly_views_chart')
{{-- POST COUNT --}}
@include('website::admin.layouts.modules.dashboard.post.model_count')
@endif