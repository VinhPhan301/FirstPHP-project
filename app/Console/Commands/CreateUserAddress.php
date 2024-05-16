<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Repositories\Product\AddressRepository;
use App\Repositories\Product\UserRepository;
use App\Constants\AddressConstant;
use App\Constants\MessageConstant;
use Carbon\Carbon;

class CreateUserAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'userAddress:create';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User Address';


    public function __construct(
        AddressRepository $addressRepository,
        UserRepository $userRepository,
    ) {
        parent::__construct();
        $this->addressRepository = $addressRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::info(MessageConstant::START);
            $users = $this->userRepository->getAll();
            foreach ($users as $user) {
                $attributes = [
                    AddressConstant::USER_ID => $user->id,
                    AddressConstant::ADDRESS => $user->address,
                    AddressConstant::RECIPIENT_NAME => $user->name,
                    AddressConstant::RECIPIENT_PHONE => $user->phone,
                    AddressConstant::STATUS => 'default',

                ];

                $userAddress = $this->addressRepository->create($attributes);
            }
        } catch (\Exception $e) {
            Log::error(MessageConstant::ERROR);
            Log::error($e->getMessage());
        }
    }
}
