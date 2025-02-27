<section class="mt-5">
    <header>
        <h2 class="text-lg fw-bold text-dark">
            Delete Account
        </h2>

        <p class="mt-1">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button 
        type="button" 
        class="btn btn-danger mt-3" 
        data-toggle="modal" 
        data-target="#confirmUserDeletionModal">
        Delete Account
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.profile.destroy') }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">Are you sure you want to delete your account?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control" 
                                placeholder="Password" required>
                            @if ($errors->userDeletion->has('password'))
                                <div class="text-danger mt-1">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Ensure modals are working properly
        $('#confirmUserDeletionModal').on('shown.bs.modal', function () {
            $('#password').trigger('focus');
        });
    });
</script>
