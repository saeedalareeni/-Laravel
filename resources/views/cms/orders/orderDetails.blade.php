@extends('cms.parent')
@section('content')
    <div class="card">
        @if ($message->image)
            <div class="card-header">
                <h3 class="card-title">
                    <img src="{{ Storage::url($message->image) }}" alt="" width="100%">
                </h3>
            </div>
        @endif
        <div class="card-body">
            <h3>{{ $message->title }}</h3>
            <hr>
            {{ $message->message }}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <p><span class="text-white-50">Student Name: </span> {{ $message->student_name }}</p>
            <p><span class="text-white-50">Student University Id: </span>{{ $message->student_university_id }}</p>
            <p><span class="text-white-50">Student Email: </span>{{ $message->student_email }}</p>
            <p><span class="text-white-50">Message Type: </span>{{ $message->type }}</p>
            
            <div class="d-flex flex-row justify-content-between my-3">
                <span class="text-left w-25 text-white-50">Message Send At: </span>
                <span class="text-right w-100">{{ $message->created_at }} </span>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
    @if ($message->status == 'open')
        <form action="{{ route('message.replayDone', $message->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body bg-dark">
                <div class="form-group">
                    <label for="message">Response</label>
                    <textarea class="form-control" id="response" name="response" cols="30" rows="5">{{ old('response') }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    @else
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>you have already replied to this message.</h4>
                </div>
            </div>
            <div class="card-body">
                {{ $message->response }}
            </div>
            <!-- /.card-body -->
            <div class="card-footer d-flex flex-row justify-content-between">
                <span class="text-left w-25">Response at: </span>
                <span class="text-right w-100">{{ $message->closed_date }} </span>

            </div>
            <!-- /.card-footer-->
        </div>
    @endif
@endsection
