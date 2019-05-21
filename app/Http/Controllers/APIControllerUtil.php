<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Exception;

class APIController extends Controller {
    public static function validatedRequest(Request $request, $validationRules, $successfulCallback) {
        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(
                [ 'error' => true
                , 'messages' => $validator->messages()
                ]);
        }

        $response = response();

        DB::transaction(function() use ($successfulCallback, $request, &$response) {
            $response = $successfulCallback($request);
        });

        return $response;
    }

    public function getRecordById($recordId, String $modelName) {
        try {
            $record = $modelName::findOrFail($recordId);
        } catch (ModelNotFoundException $exception) {
            throw new Exception("ERROR: Record $modelName not found with id: $recordId");
        }
        return $record;
    }
}
