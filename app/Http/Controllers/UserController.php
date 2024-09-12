<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpWord\TemplateProcessor;

class UserController extends Controller
{
    private const PER_PAGE = 20;
    protected $fileService;

    public function __construct(private User $users, FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(Request $request): JsonResponse
    {
        $user = $this->getUser();
        $usersQuery = $this->users
            ->with(['userable' => function ($morphTo) {
                $morphTo->morphWith([
                    Client::class => ['clubCards'],
                ]);
            }]);

        if ($query = $request->query('query')) {
            $usersQuery->whereHas('userable', function ($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                    ->orWhere('middle_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%");

            })
                ->orWhere(function ($q) use ($query) {
                    $q->where('userable_type', Client::class)
                        ->whereHasMorph('userable', [Client::class], function ($clientQuery) use ($query) {
                            $clientQuery->where('phone_number', 'like', "%{$query}%");
                        });
            });
        }

        $users = $usersQuery->paginate(self::PER_PAGE);

        return new JsonResponse(
            [
                'users' => UserResource::collection($users),
                'limit' => self::PER_PAGE,
                'total' => $users->total(),
                'url'   => route('users.list')
            ]
        );
    }

    public function getAllUsers(): JsonResponse
    {
        $users = User::all();

        return new JsonResponse(
            [
                'users' => UserResource::collection($users),
            ]
        );
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request, &$user) {


            if ($request->getRoleId() == User::ROLE_ADMIN || $request->getRoleId() == User::ROLE_MANAGER) {
                $userable = new Employee([
                    'first_name' => $request->getFirstName(),
                    'middle_name' => $request->getMiddleName(),
                    'last_name' => $request->getLastName(),
                    'branch_id' => $request->getBranchId(),
                    // Add any other employee fields here
                ]);
                $userable->save();

            } elseif ($request->getRoleId() == User::ROLE_CLIENT) {

                $newContractNumber = (int)Client::orderBy('contract_number', 'desc')
                    ->value('contract_number') + 1 ?? Client::CONTRACT_START_NUMBER;


                $userable = new Client([
                'first_name' => $request->getFirstName(),
                'middle_name' => $request->getMiddleName(),
                'last_name' => $request->getLastName(),
                'birthday' => $request->getBirthday(),
                'passport_series' => $request->getPassportSeries(),
                'passport_number' => $request->getPassportNumber(),
                'passport_notes' => $request->getPassportNotes(),
                'passport_issue_date' => $request->getPassportIssueDate(),
                'registration_address' => $request->getRegistrationAddress(),
                'inn' => $request->getInn(),
                'phone_number' => $request->getPhone(),
                'comment' => $request->getComment(),
                'balance' => $request->getBalance(),
                'bonus_points' => $request->getBonusPoints(),
                'complaints' => $request->getComplaints(),
                'last_check_fssp' => $request->getLastCheckFssp(),
                'last_check_enforcement' => $request->getLastCheckEnforcement(),
                'type' => $request->getType(),
                'company_name' => $request->getCompanyName(),
                'reg_number' => $request->getRegNumber(),
                'jur_address' => $request->getJurAddress(),
                'fact_address' => $request->getFactAddress(),
                'director' => $request->getDirector(),
                'bank_details' => $request->getBankDetails(),
//                'contract_number' => $request->getContractNumber(),
                 'contract_number' => $newContractNumber,
              ]);

                $userable->save();

                // Attach categories if provided
                if ($request->getCategoryIds()) {
                    $userable->categories()->attach($request->getCategoryIds());
                }



             }

                $user = $this->users->newInstance();
                $user->email = $request->getEmail();
                $user->password = Hash::make($request->getPassword());
                $user->role_id = $request->getRoleId();
                $user->is_active = $request->isActive();
                $user->userable()->associate($userable);
                $user->save();



        });

        // Load the userable relationship for the resource
        $user->load('userable');

        return new JsonResponse(['user' => UserResource::make($user)]);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->users->with('userable')->find($id);

        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        return new JsonResponse(['user' => UserResource::make($user)]);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->users->with('userable')->find($id);
        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        DB::transaction(function () use ($user, $request) {
            $user->email = $request->getEmail();
            $user->role_id = $request->getRoleId();
            $user->is_active = $request->isActive();
            if ($request->getPassword()) {
                $user->password = Hash::make($request->getPassword());
            }
            $user->save();

            if ($user->userable instanceof Employee) {
                $user->userable->update([
                    'first_name' => $request->getFirstName(),
                    'middle_name' => $request->getMiddleName(),
                    'last_name' => $request->getLastName(),
                    'branch_id' => $request->getBranchId(),
                    // Update other employee fields as needed
                ]);
            } elseif ($user->userable instanceof Client) {
                $user->userable->update([
                    'first_name' => $request->getFirstName(),
                    'middle_name' => $request->getMiddleName(),
                    'last_name' => $request->getLastName(),
                    'birthday' => $request->getBirthday(),
                    'passport_series' => $request->getPassportSeries(),
                    'passport_number' => $request->getPassportNumber(),
                    'passport_notes' => $request->getPassportNotes(),
                    'passport_issue_date' => $request->getPassportIssueDate(),
                    'registration_address' => $request->getRegistrationAddress(),
                    'inn' => $request->getInn(),
                    'phone_number' => $request->getPhone(),
                    'comment' => $request->getComment(),
                    'balance' => $request->getBalance(),
                    'bonus_points' => $request->getBonusPoints(),
                    'complaints' => $request->getComplaints(),
                    'last_check_fssp' => $request->getLastCheckFssp(),
                    'last_check_enforcement' => $request->getLastCheckEnforcement(),
                    'type' => $request->getType(),
                    'company_name' => $request->getCompanyName(),
                    'reg_number' => $request->getRegNumber(),
                    'jur_address' => $request->getJurAddress(),
                    'fact_address' => $request->getFactAddress(),
                    'director' => $request->getDirector(),
                    'bank_details' => $request->getBankDetails(),
                    'contract_number' => (int)$request->getContractNumber() === 0 ? NULL : $request->getContractNumber(),
                ]);

                // Update categories if provided
                if ($request->getCategoryIds()) {
                    $user->userable->categories()->sync($request->getCategoryIds());
                }
            }
        });

        $user->refresh();
        return new JsonResponse(['user' => UserResource::make($user)]);
    }

    public function delete(int $id): JsonResponse
    {
        $user = $this->users->find($id);
        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        DB::transaction(function () use ($user) {
            // Delete the associated Employee or Client
            if ($user->userable) {
                $user->userable->delete();
            }
            $user->delete();
        });

        return $this->success();
    }

    public function current(): JsonResponse
    {
        return new JsonResponse(['user' => UserResource::make(auth()->user())]);
    }

    public function managersList(): JsonResponse
    {
        $managersList = [];
        $managers = User::whereIn('role_id', [User::ROLE_MANAGER, User::ROLE_ADMIN])->get();

        foreach ($managers as $manager) {
            $managersList[] = ['id' => $manager->id, 'email' => $manager->getEmail()];
        }

        return new JsonResponse(['managers' => $managersList]);
    }

    public function adminsList(): JsonResponse
    {
        $adminsList = [];
        $admins = User::whereIn('role_id', [User::ROLE_MANAGER, User::ROLE_ADMIN])->get();

        foreach ($admins as $admin) {
            $adminsList[] = ['id' => $admin->id, 'email' => $admin->getEmail()];
        }

        return new JsonResponse(['admins' => $adminsList]);
    }

    public function clientsList(): JsonResponse
    {
        $adminsList = [];
        $clients = User::where('role_id', '=', User::ROLE_CLIENT)->get();
        $clientsList = [];

        foreach ($clients as $client) {
            $clientsList[] = ['id' => $client->id, 'fullName' => $client->userable->getFullName()];
        }

        return new JsonResponse(['clients' => $clientsList]);
    }

    public function getRoles()
    {
        return new JsonResponse(
            [
                'roles' => [
                    ['id' => User::ROLE_ADMIN, 'name' => 'Администратор'],
                    ['id' => User::ROLE_MANAGER, 'name' => 'Менеджер'],
                    ['id' => User::ROLE_CLIENT, 'name' => 'Клиент'],
                ]
            ]
        );
    }

    public function contract(int $userId, string $type)
    {
        $user = $this->users->with('userable')->find($userId);

        if (!$user) {
            return $this->error('Пользователь не найден');
        }

        $clientType = $user->userable->type;

        $contractTemplateName =  match ($type) {
            'without_driver' => 'contract_without_driver.docx',
            'with_driver' => 'contract_with_driver.docx',
            'card' => 'contract_card.docx',
            'certificate' => 'contract_certificate.docx',
            default => throw new \Exception("Invalid contract type"),
        };

        if ($this->getUser()->isAdmin()) {
            $template = new TemplateProcessor(storage_path('templates/'.$contractTemplateName ));

            if ($clientType == Client::TYPE_JUR) {
                $clientTypeText = 'Дееспособное ООО';
                $clientDataText = $user->userable->company_name.', ИНН '.$user->userable->inn . ', ОГРН ' . $user->userable->reg_number . ', юридический адрес: ' . $user->userable->jur_address .
                    ', фактический адрес: '.$user->userable->fact_address.', директор: '.$user->userable->registration_address.
                    ', данные банка: '.$user->userable->bank_details;

            } else if ($clientType == Client::TYPE_PHYS) {
                $clientTypeText = 'Дееспособное физическое лицо';

                $clientBirthday = $user->userable->birthday ? Carbon::parse($user->userable->birthday)->format('d.m.Y') : '';

                $clientDataText = $user->userable->getFullName() . ',' . $clientBirthday . ', г.р., паспорт серии ' . $user->userable->passport_series . '№ ' . $user->userable->passport_number .
                ', выдан '.$user->userable->passport_notes.', зарегистрирован(а) по адресу: '.$user->userable->registration_address.', ИНН '.$user->userable->inn.'к.т. '.$user->userable->phone_number;



            } else {
                return $this->error('Неизвестный тип пользователя');
            }


            $contractNumber = (int)$user->userable->value('contract_number');

            $template->setValue('contractNumber', $contractNumber);
            $template->setValue('contractDate', Carbon::now()->format('d.m.Y'));

            $template->setValue('clientType', $clientTypeText);
            $template->setValue('clientData', $clientDataText);

            $template->setValue('clientPhone', $user->userable->phone_number);

            // Ensure the directory exists
            $tempDirPath = storage_path('app/public/temp');
            if (!FileFacade::exists($tempDirPath)) {
                FileFacade::makeDirectory($tempDirPath, 0755, true);
            }

            // Save the document to a temporary file
            $tempFilePath = storage_path('app/public/temp/' . $user->id . '-'.$contractTemplateName);
            $template->saveAs($tempFilePath);

            // Create a Request object with the file
            $uploadedFile = new \Illuminate\Http\UploadedFile(
                $tempFilePath,
                $user->id . '-' . $contractTemplateName,
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                null,
                true // Assuming the file is already moved
            );

            $file = $this->fileService->upload($uploadedFile, 'user', $userId);

            // Delete the temporary file
            FileFacade::delete($tempFilePath);

            //save the contract record with a unique number
//            $contract = new Contract([
//                'contract_number' => $contractNumber,
//                'file_id' => $file->id,
//            ]);
//            $contract->save();

            // Return the file for download
            return response()->download(storage_path('app/public/' . $file->path), $file->filename);
        }

        return $this->error('Недостаточно прав');
    }
}
