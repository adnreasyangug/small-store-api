<?php

namespace App\Services\User;

use Exception;
use App\Models\User;
use App\Services\User\Dto\EditUsersDto;
use App\Services\User\Dto\CreateUsersDto;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return User::all();
    }

    /**
     * @param CreateUsersDto $dto
     * @return User
     */
    public function createUser(
        CreateUsersDto $dto
    ): User
    {
        return User::create([
            'first_name' => $dto->getFirstName(),
            'last_name' => $dto->getLastName(),
            'email' => $dto->getEmail(),
            'phone' => $dto->getPhone(),
            'password' => bcrypt($dto->getPassword()),
        ]);
    }

    /**
     * @param User $user
     * @param EditUsersDto $dto
     * @return User
     */
    public function editUser(
        User         $user,
        EditUsersDto $dto
    ): User
    {
        $user->update([
            'first_name' => $dto->getFirstName(),
            'last_name' => $dto->getLastName(),
            'email' => $dto->getEmail(),
            'phone' => $dto->getPhone(),
        ]);

        return $user;
    }

    /**
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function deleteUser(
        User $user
    ): string
    {
        try {
            $user->delete();
            return trans('user.delete.success');
        } catch (Exception $e) {
            throw new Exception(trans('user.delete.failed'));
        }
    }
}
