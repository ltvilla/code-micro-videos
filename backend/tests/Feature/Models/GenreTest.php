<?php

namespace Tests\Feature;

use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        $genre = Genre::create([
            'name' => 'test1'
        ]);
        $genres = Genre::all();
        $this->assertCount(1, $genres);
        $genreKey = array_keys($genre->first()->getAttributes());
        $this->assertEqualsCanonicalizing([
            'id', 'name', 'is_active', 'created_at', 'updated_at', 'deleted_at'
        ], $genreKey);
    }

    public function testCreate()
    {
        $genre = Genre::create([
            'name' => 'test1'
        ]);
        $genre->refresh();

        $this->assertEquals(36, strlen($genre->id));
        $this->assertEquals('test1', $genre->name);
        $this->assertTrue($genre->is_active);

        $genre = Genre::create([
            'name' => 'test1',
            'is_active'=> false
        ]);
        $this->assertFalse($genre->is_active);

        $genre = Genre::create([
            'name' => 'test1',
            'is_active'=> true
        ]);
        $this->assertTrue($genre->is_active);
    }

    public function testUpdate()
    {
        $genre = factory(Genre::class)->create([
            'name' => 'test_name',
            'is_active' => false
        ]);
        $genre->update([
            'name' => 'test_name_updated',
            'is_active' => true
        ]);

        $data = [
            'name' => 'test_name_updated',
            'is_active' => true
        ];
        foreach ($data as $key => $value) {
            $this->assertEquals($value, $genre->{$key});
        }
    }

    public function testDelete()
    {
        $genre = factory(Genre::class)->create();
        $genre->delete();
        $this->assertNull(Genre::find($genre->id));

        $genre->restore();
        $this->assertNotNull(Genre::find($genre->id));
    }
}
