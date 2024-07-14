<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubCard\CreateClubCardRequest;
use App\Http\Requests\ClubCard\UpdateClubCardRequest;
use App\Http\Resources\ClubCardResource;
use App\Models\ClubCard;
use Illuminate\Http\JsonResponse;

class ClubCardController extends Controller
{
    public function __construct(private ClubCard $clubCards)
    {
    }

    public function index($clientId)
    {
        $clubCards = $this->clubCards->where('client_id', $clientId)->get();
        return new JsonResponse(['clubCards' => ClubCardResource::collection($clubCards)]);
    }

    public function store(CreateClubCardRequest $request): JsonResponse
    {
        $clubCard = $this->clubCards->newInstance();

        $clubCard->client_id = $request->getClientId();
        $clubCard->club_card_level_id = $request->getClubCardLevelId();
        $clubCard->is_active = $request->getIsActive();


        $clubCard->save();

        return new JsonResponse(['clubCard' => ClubCardResource::make($clubCard)]);
    }

    public function show(int $id): JsonResponse
    {
        $clubCard = $this->clubCards->find($id);

        if (!$clubCard) {
            return $this->error('Карта не найдена');
        }

        return new JsonResponse(['clubCard' => ClubCardResource::make($clubCard)]);
    }

    public function update(UpdateClubCardRequest $request, int $id): JsonResponse
    {
        $clubCard = $this->clubCards->find($id);

        if (!$clubCard) {
            return $this->error('Карта не найдена');
        }

        $clubCard->client_id = $request->getClientId();
        $clubCard->club_card_level_id = $request->getClubCardLevelId();
        $clubCard->is_active = $request->getIsActive();

        $clubCard->save();

        return new JsonResponse(['clubCard' => ClubCardResource::make($clubCard)]);
    }

    public function delete(int $id): JsonResponse
    {
        $clubCard = $this->clubCards->find($id);

        if (!$clubCard) {
            return $this->error('Карта не найдена');
        }

        $clubCard->delete();

        return $this->success();
    }

}
