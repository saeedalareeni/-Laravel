<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complaints & Suggestion</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
</head>

<body class="dark-mode">
    <div class="container my-5">

        <div class="card ">
            <div class="card-header">
                <h2 class="card-title">Complaints & Suggestion</h2>
            </div>
            @if (session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <!-- form start -->
            <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="student_id">Student University Id</label>
                                <input type="text" class="form-control" id="student_id" name="student_university_id"
                                    value="{{ old('student_university_id') }}" placeholder="Enter University Id">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="student_name">Student Name</label>
                                <input type="text" class="form-control" id="student_name" placeholder="Enter Name"
                                    value="{{ old('student_name') }}" name="student_name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_email">Student Email</label>
                                <input type="email" class="form-control" value="{{ old('student_email') }}"
                                    id="student_email" name="student_email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">type</label>
                                <select class="form-control" name="type" value="{{ old('type') }}" id="type">
                                    <option>Complaint</option>
                                    <option>Suggestion</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{ old('title') }}" class="form-control" id="title"
                            name="title" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" cols="30" rows="5">{{ old('message') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" value="{{ old('image') }}" class="custom-file-input"
                                    name="image" id="image">
                                <label class="custom-file-label" for="image">Upload Image</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" @checked(old('urgent'))
                                name="urgent" id="urgent">
                            <label class="custom-control-label" for="urgent">Urgent</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('message.search') }}" class="btn btn-default float-right">Revision Your Message</a>
                </div>
            </form>
        </div>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('cms/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('cms/dist/js/demo.js') }}"></script>
    <script src="{{ asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('cms/dist/js/pages/dashboard2.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>
