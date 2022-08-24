<?php

namespace Frontend\Http\Controllers\Profile;

use Backend\Http\Resources\API\v1\Dictionaries\CountryResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryLocalizationResource;
use Backend\Http\Resources\API\v1\Dictionaries\DictionaryResource;
use Backend\Models\Dictionaries\Autoria\Mark;
use Backend\Models\Dictionaries\Autoria\Transmissions;
use Backend\Models\Dictionaries\Autoria\TsType;
use Backend\Models\Dictionaries\Country;
use Carbon\Carbon;
use Frontend\Http\Controllers\Controller;
use Frontend\Http\Requests\Profile\ObjInsuranceBuildingRequest;
use Frontend\Http\Requests\Profile\ObjInsuranceCarRequest;
use Frontend\Http\Requests\Profile\ObjInsurancePersonRequest;
use Frontend\Models\ObjInsuranceCars;
use Frontend\Models\ObjInsuranceBuildings;
use Frontend\Models\ObjInsurancePerson;
use Illuminate\Http\Request;

class ObjInsuranceController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    /**
     * @param ObjInsurancePersonRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPerson(ObjInsurancePersonRequest $request)
    {

        $user = auth()->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $person = ObjInsurancePerson::create($data);

        return response()->json([
            'status' => 'success',
            'type' => 'person',
            'message' => __( 'Данные успешно сохранены' ),
                'html' => view('profile.card.objInsurance.edit-person', [
                    'user' => $user,
                    'person' => $person,
                ])->render(),
        ], 200);


    }


    /**
     * @param ObjInsurancePersonRequest $request
     * @param ObjInsurancePerson $person
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePerson(ObjInsurancePersonRequest $request, ObjInsurancePerson $person)
    {
        $user = auth()->user();
        $data = $request->all();
        $person->update($data);

        return response()->json([
            'status' => 'success',
            'id' => $person->id,
            'type' => 'person',
            'message' => __( 'Данные успешно сохранены' ),
            'html' => view('profile.card.objInsurance.edit-person', [
                'user' => $user,
                'person' => $person,
            ])->render(),
        ], 200);

    }


    /**
     * @param ObjInsuranceCarRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCar(ObjInsuranceCarRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $car = ObjInsuranceCars::create($data);
        $result = Mark::all();
        $years = range(Carbon::now()->year, 1990);
        $transmissions = Transmissions::all();
        $tsTypes = TsType::all();

        return response()->json([
            'status' => 'success',
            'type' => 'car',
            'message' => __( 'Данные успешно сохранены' ),
            'html' => view('profile.card.objInsurance.card-car', [
                'user' => $user,
                'car' => $car,
                'marks' => DictionaryResource::collection($result),
                'years' => $years,
                'transmissions' => DictionaryResource::collection($transmissions),
                'tsTypes' => DictionaryLocalizationResource::collection($tsTypes),
            ])->render(),
        ], 200);
    }

    /**
     * @param ObjInsuranceCarRequest $request
     * @param ObjInsuranceCars $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCar(ObjInsuranceCarRequest $request, ObjInsuranceCars $car)
    {
        $user = auth()->user();
        $data = $request->all();
        $car->update($data);
        $result = Mark::all();
        $years = range(Carbon::now()->year, 1990);
        $transmissions = Transmissions::all();
        $tsTypes = TsType::all();

        return response()->json([
            'status' => 'success',
            'type' => 'car',
            'id' => $car->id,
            'message' => __( 'Данные успешно сохранены' ),
            'html' => view('profile.card.objInsurance.card-car', [
                'user' => $user,
                'car' => $car,
                'marks' => DictionaryResource::collection($result),
                'years' => $years,
                'transmissions' => DictionaryResource::collection($transmissions),
                'tsTypes' => DictionaryLocalizationResource::collection($tsTypes),
            ])->render(),
        ], 200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createBuilding(ObjInsuranceBuildingRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $building = ObjInsuranceBuildings::create($data);
        $country = Country::where('is_valid', 1)->where('is_disabled', 0)->where('id', 1)->first();


        return response()->json([
            'status' => 'success',
            'type' => 'building',
            'message' => __( 'Данные успешно сохранены' ),
            'html' => view('profile.card.objInsurance.card-building', [
                'user' => $user,
                'building' => $building,
                'country' => new CountryResource($country),
            ])->render(),
        ], 200);
    }


    /**
     * @param Request $request
     * @param ObjInsuranceBuildings $building
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBuilding(ObjInsuranceBuildingRequest $request, ObjInsuranceBuildings $building)
    {
        $user = auth()->user();
        $data = $request->all();
        $building->update($data);
        $country = Country::where('is_valid', 1)->where('is_disabled', 0)->where('id', 1)->first();

        return response()->json([
            'status' => 'success',
            'type' => 'building',
            'id' => $building->id,
            'message' => __( 'Данные успешно сохранены' ),
            'html' => view('profile.card.objInsurance.card-building', [
                'user' => $user,
                'building' => $building,
                'country' => new CountryResource($country),
            ])->render(),
        ], 200);
    }


}
