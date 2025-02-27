
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-user-deletion">
        Delete Account
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionLabel">Are you sure you want to delete your account?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.

                    <form method="post" action="{{ route('bdm.profile.destroy') }}" class="mt-3">
                        @csrf
                        @method('delete')
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            @if ($errors->userDeletion->has('password'))
                                <div class="text-danger mt-2">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger ms-3">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   <script>
    $(document).ready(function() {
        // Ensure modals are working properly
        $('#confirm-user-deletion').on('shown.bs.modal', function () {
            $('#password').trigger('focus')
        });
    });
</script> 
</section>
