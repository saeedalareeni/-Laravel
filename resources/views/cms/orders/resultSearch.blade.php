<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

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
    <div class="container">
        <div class="card">
            @if ($message->image)
                <div class="card-header">
                    <h3 class="card-title">
                        <img src="{{ Storage::url($message->image) }}" alt="" width="100%">
                    </h3>
                </div>
            @endif
            <div class="card-body">
                <h3><span class="text-white-50">Title: </span>{{ $message->title }}</h3>
                <hr>
                <p><span class="text-white-50">Message:</span> {{ $message->message }}</p>
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
        @if ($message->response == '')
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Your message has not been answered yet.</h4>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4>Response for your message</h4>
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
        <a href="{{ route('message.send') }}" class="btn btn-info mb-4">Send Another Message</a>
    </div>

    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('cms/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms/dist/js/adminlte.js') }}"></script>

    <!-- jQuery Mapael -->
    <script src="{{ asset('cms/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('cms/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('cms/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('cms/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('cms/dist/js/pages/dashboard2.js') }}"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
