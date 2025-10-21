<?php



namespace Tests\Feature;
use function Pest\Laravel\get;

use Tests\TestCase;
use App\Models\Facility;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


// Removed invalid global factory creation. Move this logic into test methods or setUp().

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_fake_service_and_checks_fields()
    {
        // Arrange - create a fake service using the factory
        $service = Service::factory()->make(); // 'make' does NOT save to DB

        // Assert that fake fields exist
        $this->assertNotEmpty($service->Name);
        $this->assertNotEmpty($service->Category);
        $this->assertNotEmpty($service->SkillType);
    }

    /** @test */
public function it_creates_a_service_linked_to_a_facility()
{
    $facility = Facility::factory()->create();

    $service = Service::factory()->create([
        'facility_id' => $facility->id,
        'Name' => 'Cleaning',
        'Category' => 'General',
        'SkillType' => 'Basic',
    ]);

    $this->assertDatabaseHas('services', [
        'facility_id' => $facility->id,
        'Name' => 'Cleaning',
        'Category' => 'General',
        'SkillType' => 'Basic',
    ]);
}

/** @test */
public function it_saves_a_fake_service_to_database()
{
    $facility = Facility::factory()->create();
    // Act - create and persist to DB
    $service = Service::factory()->create([
        'facility_id' => $facility->id,
        'Name' => 'Cleaning',
        'Category' => 'General',
        'SkillType' => 'Basic',
        ]);

        // Assert - check that it was stored
        $this->assertDatabaseHas('services', [
            'facility_id' => $facility->id,
            'Name' => 'Cleaning',
            'Category' => 'General',
        ]);
    }

    /** @test */
    public function it_uses_fake_http_to_test_external_service_call()
    {
        \Illuminate\Support\Facades\Http::fake([
            'https://api.example.com/*' => \Illuminate\Support\Facades\Http::response(['status' => 'ok'], 200),
        ]);

      $response = \Illuminate\Support\Facades\Http::get('https://api.example.com/services');

$this->assertEquals(200, $response->status());
$this->assertEquals('ok', $response->json()['status']);

    }

    /** @test */
    public function required_fields_are_validated()
    {
        // Try creating a service with missing required fields
        $service = new Service();

        $this->expectException(\Illuminate\Database\QueryException::class);

        $service->save(); // should fail since required fields are null
    }
     /** @test */
    public function service_name_must_be_unique_within_facility()
    {
        $facility = Facility::factory()->create();

        // First service with name 'Cleaning'
        Service::factory()->create([
            'facility_id' => $facility->id,
            'Name' => 'Cleaning',
        ]);

        // Second service with same name and facility should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Service::factory()->create([
            'facility_id' => $facility->id,
            'Name' => 'Cleaning', // duplicate name within same facility
        ]);
    }
    /** @test */
    public function service_name_can_repeat_in_different_facilities()
    {
        $facilityA = Facility::factory()->create();
        $facilityB = Facility::factory()->create();

        Service::factory()->create([
            'facility_id' => $facilityA->id,
            'Name' => 'Cleaning',
        ]);

        // This should succeed because facility is different
        $service = Service::factory()->create([
            'facility_id' => $facilityB->id,
            'Name' => 'Cleaning',
        ]);

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'Name' => 'Cleaning',
        ]);
    }

    /** @test */
    public function cannot_delete_service_if_project_references_its_category()
    {
        $facility = Facility::factory()->create();

        $service = Service::factory()->create([
            'facility_id' => $facility->id,
            'Category' => 'General',
        ]);

        // Create a project that depends on this service's category
        Project::factory()->create([
            'facility_id' => $facility->id,
            'TestingRequirements' => ['General'],
        ]);

        // Assume delete guard in Service model (before deleting)
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Service in use by Project testing requirements.');

        $service->delete();
    }
}
