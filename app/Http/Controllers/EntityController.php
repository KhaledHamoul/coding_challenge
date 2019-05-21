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
    }

    /**
     * Return one entity
     */
    public function show(Request $request, $entityId) {
        //TODO
    }

    /**
     * Creates one entity
     */
    public function store(Request $request) {
        //TODO
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
