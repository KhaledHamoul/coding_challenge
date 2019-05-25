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

    public function setUp(): void
    {
        parent::setUp();
        $fields = [
            ["name" => "sbjt_name", "label" => "Subject Name", "fieldType" => "BASIC"],
            ["name" => "sbjt_age", "label" => "Subject Age", "fieldType" => "BASIC"],
            ["name" => "sbjt_fake", "label" => "Subject Fake", "fieldType" => "BASIC"]
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

        $response = $this->get('/api/entities');
        $response->assertStatus(200)
                ->assertJson($entities->toArray());
    }

    /**
     * Get entity by its ID.
     *
     * @return void
     */
    public function testShow()
    {
        $entity = factory(Entity::class)->create();

        $response = $this->get('/api/entities/' . $entity->id );
        $response->assertStatus(200)
                ->assertJson($entity->toArray());
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
                ->assertJson(['entity' => [ "fieldType" => "SUBJECT" ] ]);

        $this->assertEquals(2, Value::where('entity_id', $response->original['entity']['id'] )->count());
    }
}
