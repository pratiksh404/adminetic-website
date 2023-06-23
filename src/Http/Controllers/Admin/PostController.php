<?php

namespace Adminetic\Website\Http\Controllers\Admin;

use Adminetic\Website\Models\Admin\Post;
use Illuminate\Http\Request;
use Adminetic\Website\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Adminetic\Website\Contracts\PostRepositoryInterface;

class PostController extends Controller
{
    protected $postRepositoryInterface;

    public function __construct(PostRepositoryInterface $postRepositoryInterface)
    {
        $this->postRepositoryInterface = $postRepositoryInterface;
        $this->authorizeResource(Post::class, 'post');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website::admin.post.index', $this->postRepositoryInterface->indexPost());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('website::admin.post.create', $this->postRepositoryInterface->createPost());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->postRepositoryInterface->storePost($request);
        return redirect(adminRedirectRoute('post'))->withSuccess('Post Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('website::admin.post.show', $this->postRepositoryInterface->showPost($post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Website\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('website::admin.post.edit', $this->postRepositoryInterface->editPost($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Website\Http\Requests\PostRequest  $request
     * @param  \Adminetic\Website\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->postRepositoryInterface->updatePost($request, $post);
        return redirect(adminRedirectRoute('post'))->withInfo('Post Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Website\Models\Admin\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postRepositoryInterface->destroyPost($post);
        return redirect(adminRedirectRoute('post'))->withFail('Post Deleted Successfully.');
    }
}
