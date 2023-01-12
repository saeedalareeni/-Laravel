@extends('cms.parent')
@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Student Email</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>closed Date</th>
                    <th>Urgent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->student_email }}</td>
                        <td>{{ $message->type }}</td>
                        <td class="{{ $message->status == 'open' ? 'text-lime':'text-maroon'  }}">{{ $message->status }}</td>
                        <td>{{ $message->closed_date ?? ' - - ' }}</td>
                        <td class="{{  $message->urgent  ? ' text-lime ':'text-maroon'  }}">{{ $message->urgent ? 'Urgent' : 'Not Urgent' }}</td>
                        <td>
                            {{-- <a type="button" onclick="" class="text-cyan p-2">Details</a>
                            <a type="button" onclick="" class="p-2 text-lime">Response</a> --}}
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('message.show', $message->id) }}" class="btn bg-cyan"><i class="fas fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
