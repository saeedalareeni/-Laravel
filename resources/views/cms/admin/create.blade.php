@extends('cms.parent')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Admin</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="mobile">mobile</label>
                    <input type="text" class="form-control" id="mobile" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="addAdmin()" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function addAdmin() {
            axios.post('/cms/admin', {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    password: document.getElementById("password").value,
                    mobile: document.getElementById("mobile").value,
                })
                .then(function(response) {
                    window.location.href = '/cms/admin'
                })
                .catch(function(error) {
                    swalFire('error', error.response.data.message)
                });
        }

        function swalFire(icon, data) {
            Swal.fire({
                icon: icon,
                title: data,
                showConfirmButton: true,
                timer: false,
            });
        }
    </script>
@endsection
