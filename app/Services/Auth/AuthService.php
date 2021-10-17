<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\Dto\SignInDto;
use App\Services\Auth\Dto\SignUpDto;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @param SignInDto $dto
     * @return mixed
     * @throws Exception
     */
    public function signIn(
        SignInDto $dto
    )
    {
        try {
            $user = User::where('email', $dto->getEmail());

            if (!$user->exists() || !Hash::check($dto->getPassword(), $user->first()->password)) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed'),
                ]);
            }

            return $user->first()->createToken($dto->getIP())->plainTextToken;
        } catch (Exception $e) {
            throw new Exception(trans('auth.failed'));
        }
    }

    /**
     * @param SignUpDto $dto
     * @return string
     * @throws Exception
     */
    public function signUp(
        SignUpDto $dto
    ): string {
        try {
            User::create([
                'first_name' => $dto->getFirstName(),
                'last_Name' => $dto->getLastName(),
                'phone' => $dto->getPhone(),
                'email' => $dto->getEmail(),
                'password' => bcrypt($dto->getPassword()),
            ]);

            return trans('auth.signup.success');
        } catch (Exception $e) {
            throw new Exception(trans('auth.signup.failed'));
        }
    }
}
