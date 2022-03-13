<?php

namespace Adminetic\Website\Http\Livewire\Admin\Post;

use Adminetic\Website\Models\Admin\Category;
use Adminetic\Website\Models\Admin\Post;
use App\Models\User;
use Carbon\Carbon;
use Conner\Tagging\Model\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
{
    use WithPagination;

    public $search;

    public $filter_type = null;

    public $startDate;

    public $endDate;

    public $tag_name;

    public $user_id;

    public $categoryid;

    protected $listeners = ['date_range_filter' => 'dateRangeFilter'];

    public function mount()
    {
        $this->resetPage();
        $this->filter_type = 1;
        $this->emit('initialize_posts_table');
    }

    protected $updatesQueryString = ['posts'];

    public function allPosts()
    {
        $this->resetPage();
        $this->filter_type = 1;
        $this->emit('initialize_posts_table');
    }

    // Filter
    public function todayPosts()
    {
        $this->resetPage();
        $this->filter_type = 2;
        $this->emit('initialize_posts_table');
    }

    public function weekPosts()
    {
        $this->resetPage();
        $this->filter_type = 3;
        $this->emit('initialize_posts_table');
    }

    public function monthPosts()
    {
        $this->resetPage();
        $this->filter_type = 4;
        $this->emit('initialize_posts_table');
    }

    public function yearPosts()
    {
        $this->resetPage();
        $this->filter_type = 5;
        $this->emit('initialize_posts_table');
    }

    public function dateRangeFilter($startDate, $endDate)
    {
        $this->resetPage();
        $this->filter_type = 6;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->emit('initialize_posts_table');
    }

    public function tagPost(Tag $tag)
    {
        $this->resetPage();
        $this->filter_type = 7;
        $this->tag_name = $tag->name;
        $this->emit('initialize_posts_table');
    }

    public function publishedPosts()
    {
        $this->resetPage();
        $this->filter_type = 8;
        $this->emit('initialize_posts_table');
    }

    public function pendingPosts()
    {
        $this->resetPage();
        $this->filter_type = 9;
        $this->emit('initialize_posts_table');
    }

    public function featuredPosts()
    {
        $this->resetPage();
        $this->filter_type = 10;
        $this->emit('initialize_posts_table');
    }

    public function authorPosts(User $user)
    {
        $this->resetPage();
        $this->filter_type = 11;
        $this->user_id = $user->id;
        $this->emit('initialize_posts_table');
    }

    public function orderByPriority()
    {
        $this->resetPage();
        $this->filter_type = 12;
        $this->emit('initialize_posts_table');
    }

    public function updatedCategoryid($categoryid)
    {
        $this->resetPage();
        $this->filter_type = 13;
        $this->categoryid = $categoryid;
        $this->emit('initialize_posts_table');
    }

    public function updatedSearch()
    {
        $this->filter_type = 14;
        $this->emit('initialize_posts_table');
    }

    public function render()
    {
        $posts = $this->initializePosts();
        $tags = Tag::where('count', '>', 0)->orderBy('count', 'desc')->get();
        $authors = User::has('posts', '>', 0)->with('posts')->get();
        $parentcategories = Category::whereNull('category_id')->with('childrenCategories')->get();

        return view('website::livewire.admin.post.posts-table', compact('tags', 'authors', 'parentcategories', 'posts'));
    }

    protected function initializePosts()
    {
        $filter = $this->filter_type;
        if ($filter == 1) {
            return Post::tenent()->with('author', 'tagged')->latest()->paginate(10);
        } elseif ($filter == 2) {
            return Post::tenent()->with('author', 'tagged')->today()->paginate(10);
        } elseif ($filter == 3) {
            return  Post::tenent()->with('author', 'tagged')->week()->paginate(10);
        } elseif ($filter == 4) {
            return Post::tenent()->with('author', 'tagged')->month()->paginate(10);
        } elseif ($filter == 5) {
            return Post::tenent()->with('author', 'tagged')->year()->paginate(10);
        } elseif ($filter == 6) {
            $start = Carbon::create($this->startDate);
            $end = Carbon::create($this->endDate);

            return Post::tenent()->with('author', 'tagged')->whereBetween('updated_at', [$start->toDateString(), $end->toDateString()])->paginate(10);
        } elseif ($filter == 7) {
            return Post::tenent()->withAnyTag($this->tag_name)->with('author', 'tagged')->latest()->paginate(10);
        } elseif ($filter == 8) {
            return Post::tenent()->published()->with('author', 'tagged')->latest()->paginate(10);
        } elseif ($filter == 9) {
            return Post::tenent()->pending()->with('author', 'tagged')->latest()->paginate(10);
        } elseif ($filter == 10) {
            return Post::tenent()->featured()->with('author', 'tagged')->latest()->paginate(10);
        } elseif ($filter == 11) {
            return Post::tenent()->where('author_id', $this->user_id)->paginate(10);
        } elseif ($filter == 12) {
            return  Post::tenent()->with('author', 'tagged')->orderBy('priority', 'desc')->paginate(10);
        } elseif ($filter == 13) {
            return Post::tenent()->with('author', 'tagged')->where('category_id', $this->categoryid)->latest()->paginate(10);
        } elseif ($filter == 14) {
            return $this->searchQuery()->tenent()->with('author', 'tagged')->latest()->paginate(10);
        } else {
            return Post::tenent()->with('author', 'tagged')->latest()->paginate(10)->paginate(10);
        }
    }

    protected function searchQuery()
    {
        $search = $this->search ?? null;
        if ($search != '') {
            return Post::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('excerpt', 'LIKE', '%'.$search.'%')
                    ->orWhere('seo_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('meta_description', 'LIKE', '%'.$search.'%');
            });
        } else {
            return Post::latest();
        }
    }
}
