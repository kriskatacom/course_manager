<div class="px-5 mb-5 space-y-5">
    <form wire:submit.prevent="personalDataUpdate" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.personal_data") }}</h2>

        <div class="space-y-5 p-5">
            <div>
                <label for="name" class="form-label">Име и фамилия</label>
                <input type="text" wire:model.defer="user.name" class="form-control"
                    placeholder="{{ __("messages.enter_name") }}">
                @error('user.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updateEmail" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_email") }}</h2>

        <div class="space-y-5 p-5">
            <div>
                <label for="email" class="form-label">Текущ имейл</label>
                <input type="email" value="{{ $user->email }}" disabled="true" class="form-control">
            </div>

            <div>
                <label for="newEmail" class="form-label">Нов имейл</label>
                <input type="email" wire:model.defer="newEmail" class="form-control">
                @error('newEmail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updatePassword" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_password") }}</h2>

        <div class="space-y-5 p-5">
            @if (Auth::user()->id == $user->id)
                <div>
                    <label for="currentPassword" class="form-label">Текуща парола</label>
                    <input type="password" wire:model.defer="currentPassword" class="form-control">
                    @error('currentPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            @endif

            <div>
                <label for="newPassword" class="form-label">Нова парола</label>
                <input type="password" id="newPassword" wire:model.defer="newPassword" class="form-control">
                @error('newPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="newPassword_confirmation" class="form-label">Потвърждаване на паролата</label>
                <input type="password" id="newPassword_confirmation" wire:model.defer="newPassword_confirmation"
                    class="form-control">
            </div>

            <div>
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
            </div>
        </div>
    </form>
    <form wire:submit.prevent="updateRole" class="border border-gray-200 rounded shadow">
        <h2 class="text-xl font-semibold border-b border-gray-200 p-5">{{ __("messages.change_role") }}</h2>

        <div class="space-y-5 p-5">
            <div>
                <label for="role" class="form-label">{{ __("messages.role") }}</label>
                <select id="role" wire:model.defer="role" class="form-control">
                    <option value="">{{ __("messages.select_role") }}</option>
                    @foreach($roles as $r)
                        <option value="{{ $r->name }}" {{ $user->hasRole($r->name) ? 'selected' : '' }}>
                            {{ __("messages." . $r->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="btn-primary px-4 py-2">
                    {{ __("messages.save_changes") }}
                </button>
            </div>
        </div>
    </form>
</div>