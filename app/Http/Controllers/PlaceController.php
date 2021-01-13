<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    public function create(Request $request) {
        $place = Place::create([
            'name' => $request->name,
            'kind' => $request->kind,
            'type' => 'marker',
            'lat' => $request->lat,
            'lon' => $request->lon,
            'isDeleted' => 0
        ]);

        if($place) {
            return response()->json([
                'message' => 'Successful',
                'code' => 200
            ]);
        }

        return response()->json([
            'message' => 'Unsuccessful',
            'code' => 400
        ]);
    }

    public function getPlaces() {
        $places = Place::where('isDeleted', '=', 0)->get();

        $places_fix = [];
        foreach ($places as $place) {
            $places_fix[] = [
                'coords' => [$place->lat, $place->lon],
                'id' => $place->id,
                'name' => $place->name,
                'type' => $place->type
            ];
        }

        if($places) {
            return response()->json([
                'message' => 'Successful',
                'content' => [
                    'places' => $places
                ],
                'code' => 200
            ]);
        }

        return response()->json([
            'message' => 'Unsuccessful',
            'code' => 400
        ]);
    }

    public function getPlacesByType(Request $request) {
        $places = Place::where('kind', '=', $request->kind)->where('isDeleted', '=', 0)->get();

        $places_fix = [];
        foreach ($places as $place) {
            $places_fix[] = [
                'coords' => [$place->lat, $place->lon],
                'id' => $place->id,
                'name' => $place->name,
                'type' => $place->type
            ];
        }

        if($places) {
            return response()->json([
                'message' => 'Successful',
                'content' => [
                    'places' => $places_fix
                ],
                'code' => 200
            ]);
        }

        return response()->json([
            'message' => 'Unsuccessful',
            'code' => 400
        ]);
    }

    public function update(Request $request) {
        $place = Place::find($request->id);
        $place->update($request->all());

        return response()->json('The place successfully updated');
    }

    public function delete(Request $request, $id) {
        $place = Place::find($request->id);
        // return reponse()->json(['place' => $place]);
        // $place->delete();
        $place->isDeleted = 1;
        $place->save();

        return response()->json('The place successfully deleted');
    }
}
