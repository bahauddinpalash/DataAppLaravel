<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('recruiter.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Current Password</label>
            <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password">New Password</label>
            <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600" style="transition: opacity 2s;">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
