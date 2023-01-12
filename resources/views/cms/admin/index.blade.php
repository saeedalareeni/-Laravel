@extends('cms.parent')
@section('content')
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Email Verified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr id="admin_{{ $admin->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->mobile }}</td>
                        <td>
                            <span class="{{ $admin->email_verified_at ?? 'tag text-danger' }}">
                                {{ $admin->email_verified_at ? $admin->email_verified_at : 'Not Verified' }}
                            </span>
                        </td>
                        <td>
                            <button type="button" onclick="delete_admin({{ $admin->id }})"
                                class="btn btn-danger p-2">Delete</button>
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-success p-2">Update</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        function delete_admin(id) {
            axios.delete(`/cms/admin/${id}`)
                .then(function(response) {
                    document.getElementById(`admin_${id}`).remove();
                    swalFire('success', response.data.message);
                })
                .catch(function(error) {
                    swalFire('error', error.response.data.message);
                });
        };

        function swalFire(icon, data) {
            Swal.fire({
                icon: icon,
                title: data,
                showConfirmButton: true,
                timer: false,
            })
        }
    </script>
@endsection
