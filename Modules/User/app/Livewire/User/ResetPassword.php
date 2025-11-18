<?php

namespace Modules\User\Livewire\User;

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Modules\User\Services\UserService;

#[Layout('components.layouts.master')]
#[Title('Reset Password')]
class ResetPassword extends Component
{
    #[Validate('required|string|min:6')]
    public ?string $oldPassword = '';

    #[Validate('required|string|min:6|confirmed')]
    public ?string $newPassword = '';

    public ?string $newPassword_confirmation = '';

    protected UserService $service;

    public function boot(UserService $service)
    {
        $this->service = $service;
    }

    public function resetPassword()
    {
        $this->resetErrorBag();
        $validated = $this->validate();

        try {
            $response = $this->service->updatePassword([
                'password' => $validated['oldPassword'],
                'newPassword' => $validated['newPassword'],
            ]);

            if ($response->status) {
                $this->reset(['oldPassword', 'newPassword', 'newPassword_confirmation']);
                ToastMagic::success(__('Reset Password Successfully!'));
            } else {
                ToastMagic::error(($response->message ?? __('Somthing Wen Wrong!')));
            }

        } catch (ValidationException $e) {
            $this->addError('oldPassword', $e->getMessage());
        } catch (\Throwable $e) {
            ToastMagic::error(__('Somthing Wen Wrong On Change Password!'));
        }
    }

    public function render()
    {
        return view('user::livewire.user.reset-password');
    }
}
