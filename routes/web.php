<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function(){
        return view('admin.index', [
            'usersCount' => \App\Models\User::count(),
            'postsCount' => \App\Models\Post::count(),
            'pendingCommentsCount' => \App\Models\Comment::where('status', 'spam')->count(),
            'todaysSignups' => \App\Models\User::whereDate('created_at', today())->count(),
            'recentUsers' => \App\Models\User::latest()->take(5)->get(),
        ]);
    })->name('admin.index');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/comments', CommentController::class);
    Route::resource('/messages', MessageController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/profile', ProfileController::class);

    Route::patch('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::patch('/comments/{id}/spam', [CommentController::class, 'spam'])->name('comments.spam');

    Route::patch('/messages/{id}/read', [MessageController::class, 'read'])->name('messages.read');
    Route::patch('/messages/{id}/unread', [MessageController::class, 'unread'])->name('messages.unread');
    
    Route::patch('/users/{id}/lock', [UserController::class, 'lock'])->name('users.lock');
    Route::patch('/users/{id}/change_password', [UserController::class, 'change_password'])->name('users.change_password');

    Route::post('/profile/change_password', [ProfileController::class, 'change_password'])->name('profile.change_password');

});


Route::post('/contact', function(StoreMessageRequest $request){
    $validated = $request->validated();
    \App\Models\Message::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'subject' => $validated['subject'],
        'content' => $validated['content'],
        'status' => 'unread',
    ]);
    return redirect()->back()->with('success', 'Message sent successfully.');
})->name('messages.store');

Route::post('/blog_details', function(StoreCommentRequest $request){
    $validated = $request->validated();
    // dd($validated);
    \App\Models\Comment::create([
        'post_id' => $validated['post_id'],
        'user_id' => auth()->id(),
        'content' => $validated['content'],
        'status' => 'spam',
    ]);
    return redirect()->back()->with('success', 'Comment submitted successfully. It will be reviewed by an admin before being published.');
})->middleware('auth')->name('comments.store');

Route::get('/', function(){
    $posts = Post::latest()->take(3)->get();
    return view('homepage.index', compact('posts'));
})->name('homepage.index');

Route::get('/about', function(){
    $users = User::all();
    return view('homepage.about', compact('users'));
})->name('homepage.about');

Route::get('/services', function(){
    return view('homepage.services');
})->name('homepage.services');

Route::get('/projects', function(){
    return view('homepage.projects');
})->name('homepage.projects');

Route::get('/blog', function(){
    // I added the with method to eager load the category and user relationships
    $posts = Post::with('category', 'user')->latest()->paginate(6);
    return view('homepage.blog', compact('posts'));
})->name('homepage.blog');

Route::get('/contact', function(){
    return view('homepage.contact');
})->name('homepage.contact');

Route::get('/blog_details/{id}', function(string $id){
    $post = Post::with('category', 'user')->findOrFail($id);
    $comments = $post->comments()->where('status', 'approved')->latest()->get();
    $related_posts = Post::with('category', 'user')->latest()->take(5)->get();
    $categories = Category::all();
    $quotes = [
        "Believe you can and you're halfway there. – Theodore Roosevelt",
        "Success is not final, failure is not fatal: It is the courage to continue that counts. – Winston Churchill",
        "The only way to do great work is to love what you do. – Steve Jobs",
        "It always seems impossible until it’s done. – Nelson Mandela",
        "Don’t watch the clock; do what it does. Keep going. – Sam Levenson",
        "Dream big and dare to fail. – Norman Vaughan",
        "Push yourself, because no one else is going to do it for you.",
        "Great things never come from comfort zones.",
        "Success doesn’t just find you. You have to go out and get it.",
        "Sometimes we’re tested not to show our weaknesses, but to discover our strengths.",
        "The harder you work for something, the greater you'll feel when you achieve it.",
        "Don’t stop when you’re tired. Stop when you’re done.",
        "Wake up with determination. Go to bed with satisfaction.",
        "Do something today that your future self will thank you for.",
        "Little things make big days.",
        "It’s going to be hard, but hard does not mean impossible.",
        "Don’t wait for opportunity. Create it.",
        "The key to success is to focus on goals, not obstacles.",
        "Success is what comes after you stop making excuses.",
        "Dream it. Wish it. Do it.",
        "Don’t limit your challenges. Challenge your limits.",
        "Sometimes later becomes never. Do it now.",
        "Great minds discuss ideas; average minds discuss events; small minds discuss people. – Eleanor Roosevelt",
        "Hard work beats talent when talent doesn’t work hard.",
        "Go the extra mile. It’s never crowded.",
        "A goal without a plan is just a wish. – Antoine de Saint-Exupéry",
        "You miss 100% of the shots you don’t take. – Wayne Gretzky",
        "Act as if what you do makes a difference. It does. – William James",
        "Start where you are. Use what you have. Do what you can. – Arthur Ashe",
        "You are never too old to set another goal or to dream a new dream. – C.S. Lewis",
        "The future belongs to those who believe in the beauty of their dreams. – Eleanor Roosevelt",
        "Your limitation—it’s only your imagination.",
        "Work hard in silence. Let your success be your noise.",
        "Stay focused and never give up.",
        "Be so good they can't ignore you. – Steve Martin",
        "If it doesn’t challenge you, it won’t change you.",
        "Failure is not the opposite of success, it's part of success. – Arianna Huffington",
        "You are stronger than you think.",
        "Consistency is what transforms average into excellence.",
        "Success is liking yourself, liking what you do, and liking how you do it. – Maya Angelou",
        "Energy and persistence conquer all things. – Benjamin Franklin",
        "Keep your face always toward the sunshine—and shadows will fall behind you. – Walt Whitman"
    ];
    $random_quote = $quotes[array_rand($quotes)];
    return view('homepage.blog_details', compact('post', 'comments', 'related_posts', 'categories', 'random_quote'));
})->name('homepage.blog_details');

//this looks complicated but its easy. What this does is it gets the category name from the url and then it finds the category in the database. Then it gets all the posts that belong to that category and paginates them. Finally, it returns the view with the posts and the category. I hope I remeber this correctly.
Route::get('/category_blogs/{category_name}', function (string $category_name) {
    $category = Category::where('name', $category_name)->firstOrFail();
    $posts = Post::with('category', 'user')
                ->where('category_id', $category->id)
                ->latest()
                ->paginate(6);

    return view('homepage.category_blogs', compact('posts', 'category'));
})->name('homepage.category_blogs');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage.index');
})->name('logout');

Auth::routes([
    'register' => true,
    'reset' => true,
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
