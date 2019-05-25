<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\Value;
use App\Models\Field;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class EntityEndpointsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Before each test.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $fields = [
            ["id" => 1, "name" => "sbjt_name", "label" => "Subject Name", "fieldType" => "BASIC"],
            ["id" => 2, "name" => "sbjt_age", "label" => "Subject Age", "fieldType" => "BASIC"],
            ["id" => 3, "name" => "sbjt_fake", "label" => "Subject Fake", "fieldType" => "BASIC"]
        ];
        Field::insert($fields);  
    }
    
    /**
     * Get all entities.
     *
     * @return void
     */
    public function testIndex()
    {
        $entities = factory(Entity::class,4)->create();
        $values = [
            ["value" => "Riad", "entity_id" => $entities[0]->id, "field_id" => 1],
            ["value" => "30", "entity_id" => $entities[1]->id, "field_id" => 2],
            ["value" => "20", "entity_id" => $entities[1]->id, "field_id" => 2]
        ];
        Value::insert($values);

        $response = $this->get('/api/entities');
        $response->assertStatus(200)
                ->assertJson($entities->toArray());

        $this->assertEquals(1, Value::where('entity_id', $entities[0]->id )->count());
        $this->assertEquals(2, Value::where('entity_id', $entities[1]->id )->count());
        $this->assertEquals(0, Value::where('entity_id', $entities[2]->id )->count());
    }

    /**
     * Get entity by its ID.
     *
     * @return void
     */
    public function testShow()
    {
        $entity = factory(Entity::class)->create();
        $values = [
            ["value" => "Riad", "entity_id" => $entity->id, "field_id" => 1],
            ["value" => "30", "entity_id" => $entity->id, "field_id" => 2]
        ];
        Value::insert($values);

        $response = $this->get('/api/entities/' . $entity->id );
        $response->assertStatus(200)
                ->assertJson($entity->toArray())
                ->assertJson([
                    "sbjt_name" => "Riad",
                    "sbjt_age" => "30"
                    ]);
    }

    /**
     * Get entity and all its values.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            "entityType" => "SUBJECT", 
            "sbjt_name" => "Riad", 
            "sbjt_age"=> "30"
        ];

        $response = $this->post('/api/entities/', $data);
        $response->assertStatus(201)
                ->assertJson(['entity' => [ "entityType" => "SUBJECT" ] ]);

        $createdEntityId = $response->original['entity']['id'];
        $this->assertEquals(2, Value::where('entity_id', $createdEntityId )->count());
    }
}
