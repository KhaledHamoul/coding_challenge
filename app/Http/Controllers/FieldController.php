<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\Field;
use App\Http\Controllers\APIControllerUtil;


class FieldController extends APIController {

    public function index(Request $request) {
        return response()->json(Field::all());
    }

    public function show(Request $request, $fieldId) {
        $field = self::getRecordById($fieldId, Field::class);
        return response()->json($field->asCollection());
    }

    public function store(Request $request) {
        return self::validatedRequest($request,
            [ 'name'             => 'required|unique:Field'
            , 'label'            => 'required'
            , 'fieldType'        => 'required|in:BASIC,FIXED,FOREIGN,STATIC'
            ], function($request) {
                return response()->json(
                    [ 'error' => false
                    , 'field' => Field::create($request->all())->asCollection()
                    ]);
            });
    }

    public function destroy(Request $request, Field $field) {
        $field->details->delete();
        $field->delete();
        return response()->json([ 'error' => false ]);
    }
}
