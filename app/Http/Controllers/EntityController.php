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
        $entities = Entity::all()->map(function($entity){
            return $entity->includeValues();
        });
                                                            
        return response()->json($entities,200);
    }

    /**
     * Return one entity
     */
    public function show(Request $request, $entityId) {
        //TODO
        $entity = self::getRecordById($entityId, Entity::class)->includeValues();
        
        return response()->json($entity);
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
    public function destroy(Request $request, $entityId) {
        //TODO
        $entity = self::getRecordById($entityId, Entity::class);
        $entity->_values()->delete();
        $entity->delete();

        return response()->json([ 'error' => false ]);
    }


}
