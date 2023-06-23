@extends(request()->header('layout') ?? 'adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-index-page name="career" route="career">
        <x-slot name="content">
            {{-- ================================Card================================ --}}
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Designation</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($careers as $career)
                        <tr>
                            <td>{{ $career->title ?? 'N/A' }}</td>
                            <td>{{ $career->designation ?? 'N/A' }}</td>
                            <td>{{ $career->location ?? 'N/A' }}</td>
                            <td>{{ $career->salary ?? 'N/A' }}</td>
                            <td>{{ $career->deadline ?? 'N/A' }}</td>
                            <td>
                                <x-adminetic-action :model="$career" route="career">
                                    <x-slot name="buttons">
                                        <a href="{{ route('career.applications', ['career' => $career->id]) }}"
                                            class="btn btn-info btn-air-info p-2 btn-sm"><i class="fa fa-file"></i> <span
                                                class="mx-2 p-2"
                                                style="background-color: white;color:black">{{ $career->applications->count() }}</span></a>
                                    </x-slot>
                                </x-adminetic-action>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Designation</th>
                        <th>Location</th>
                        <th>Salary</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-index-page>
@endsection

@section('custom_js')
    @include('website::admin.layouts.modules.career.scripts')
@endsection
