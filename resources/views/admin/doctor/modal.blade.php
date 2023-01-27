<div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-0 mb-0" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">
                    Doctor Information
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <img src="{{ asset('images') }}/{{ $user->image }}" class="table-user-thumb" alt="" width="200">
                </p>
                <p class="badge badge-pill badge-dark">Role: {{ $user->role->name }}</p>
                <p>Name: {{ $user->name }}</p>
                <p>Gender: {{ $user->gender }}</p>
                <p>Email: {{ $user->email }}</p>
                <p>Address: {{ $user->address }}</p>
                <p>Phone Number: {{ $user->phone_number }}</p>
                <p>Department: {{ $user->department }}</p>
                <p>Education: {{ $user->education }}</p>
                <p>About: {{ $user->description }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>