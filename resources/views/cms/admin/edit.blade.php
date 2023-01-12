@extends('cms.parent')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Admin</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $admin->name }}"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $admin->email }}"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="email" class="form-control" id="mobile" value="{{ $admin->mobile }}"
                        placeholder="Enter Mobile">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="editAdmin({{ $admin->id }})" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function editAdmin(id) {
            axios.put(`/cms/admin/${id}`, {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
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
