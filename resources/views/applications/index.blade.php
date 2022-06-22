@extends('layout')

@section('content')

    <h3>All Applications</h3>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Created at</th>
            <th>Attachments</th>
        </tr>
        </thead>
        <tbody>
        @forelse($applications as $application)
            <tr>
                <td>
                    {{$application->id}}
                </td>
                <td>
                    {{$application->first_name}}
                </td>
                <td>
                    {{$application->last_name}}
                </td>
                <td>
                    {{$application->created_at}}
                </td>
                <td>
                    @if(count($application->attachments) >0)
                        @foreach($application->attachments as $attachment)
                            <img src="{{ route('attachments.serve', $attachment->id) }}" alt="{{$attachment->original_file_name}}" style="max-width:200px; height:auto">
                        @endforeach
                    @else
                        No attachments added.
                    @endif

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    No applications added yet.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
