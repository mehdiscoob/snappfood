<?php

namespace App\Services\user;

use App\Events\EmailEvent;
use App\Mail\VerificationCodeEmail;
use App\Models\User;
use App\Repositories\user\UserRepositoryInterface;
use App\Services\SMS\SMSContext;
use App\Services\sms\VerificationSmsStrategy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $smsContext;

    public function __construct(UserRepositoryInterface $userRepository, SMSContext $smsContext)
    {
        $this->userRepository = $userRepository;
        $smsContext->setStrategy(new VerificationSmsStrategy());
        $this->smsContext = $smsContext;
    }

    public function register(array $userData)
    {
        if (isset($userData["email"])) {
            $verificationCode = rand(100000, 999999);
        } else {
            $verificationCode = rand(10000000, 99999999);

        }

        $userData['password'] = Hash::make($userData['password']);
        $userData['verification_code'] = $verificationCode;

        // Create the user
        DB::beginTransaction();
        try {
            $token= Str::random(60);
            $userData['api_token']=$token;
            $user = $this->userRepository->create($userData);
            if ($user) {
                $user->roles()->attach(2);
                if (isset($user['email'])) {
                    event(new EmailEvent([$user['email']], new VerificationCodeEmail($verificationCode)));
                } elseif (isset($user['mobile'])) {
                    $smsSent = $this->smsContext->sendSms($user['mobile'], $verificationCode);
                }
                DB::commit();
                unset($user['verification_code']);
                return $user;
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception;
            return false;
        }


    }

    public function verifyAccount($verificationCode)
    {

        /**
         * @var $user User
         */
        $user = Auth::user();

        $verified_at = [
            "6"=>'email_verified_at',
            "8"=>'mobile_verified_at',
        ];
        if ($user && $user->verification_code === $verificationCode) {
            $data = ['verified' => true, $verified_at[strlen($verificationCode)] => now()];
            $user->update($data);
            return $user;
        }
        return false;
    }

    public function getUserById($userId)
    {
        return $this->userRepository->findById($userId);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function getUserByMobile($mobile)
    {
        return $this->userRepository->findByMobile($mobile);
    }

    public function updateUser(array $userData, $userId)
    {
        return $this->userRepository->update($userData, $userId);
    }

    public function deleteUser($userId)
    {
        return $this->userRepository->delete($userId);
    }
}
