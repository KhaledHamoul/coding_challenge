<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\Field;

use Log;

class EntityController extends APIController {

    /**
     * Return all entities
     */
    public function index(Request $request) {
        //TODO
        return response()->json(Entity::all(),200);
    }

    /**
     * Return one entity
     */
    public function show(Request $request, $entityId) {
        //TODO
        $entity = self::getRecordById($entityId, Entity::class);
        return response()->json($entity->asCollection());
    }

    /**
     * Creates one entity
     */
    public function store(Request $request) {
        //TODO
        return self::validatedRequest($request,
            [ 'entityType' => 'required|in:SUBJECT,VISIT,SAMPLE' ],
            function($request) {
                return response()->json(
                    [ 'error' => false,
                      'entity' => Entity::create($request->all())->asCollection()
                    ],201);
            });
    }
    
    /**
     * Updates on entity
     */
    public function update(Request $request, Entity $entity) {
        return self::validatedRequest($request,
            [ 'entityType_id' => 'integer|gt:0|exists:EntityType,id'
            ], function($request) {
                $entity->update($request->all());
                return response()->json([ 'error' => false, 'entity' => $entity ]);
            });
    }

    /**
     * Destroys an entity
     */
    public function destroy(Request $request, Entity $entity) {
        //TODO
    }


}
