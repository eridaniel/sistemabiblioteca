<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hash existing plain text passwords for users';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            
            if (!Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password); // Encripta la contraseña
                $user->save();
                $this->info("Hashed password for user: {$user->email}");
            }
        }
    }
}
