use App\Models\User;
use App\Models\Posts;
use App\Constants\UserConst;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('superadmin can create a post', function () {
$user = User::factory()->create([
'access_type' => UserConst::SUPERADMIN
]);

$this->actingAs($user)
->post(route('superadmin.posts.doCreate'), [
'title' => 'Test Post',
'content' => 'Test content',
])
->assertRedirect(route('superadmin.posts.index'))
->assertSessionHas('success');

$post = Posts::first();
expect($post->title)->toBe('Test Post');
// Content should be stored in rich_texts table, but trait makes it available on model
expect((string) $post->content)->toContain('Test content');
expect($post->status)->toBe('published');
expect($post->user_id)->toBe($user->id);
});