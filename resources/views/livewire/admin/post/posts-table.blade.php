<div>
    <div class="content-body">
        <section class="row all-contacts">
            <div class="col-12">
                <div class="card">
                    <div class="card-head">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-start">
                                        @isset($tags)
                                        @foreach ($tags as $tag)
                                        <button class="badge badge-primary" wire:click="tagPost({{ $tag->id }})"
                                            wire:key="{{ $tag->id }}">{{ $tag->name }}</button>
                                        @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row" id="filter_section">
                                <div class="col-lg-7">
                                    {{-- Category Filter --}}
                                    <div class="input-group">
                                        <span class="input-group-text">Category Filter</span>
                                        <select wire:model="categoryid" id="category_id" class="form-control">
                                            <option selected disabled>Select Category</option>
                                            @isset($parentcategories)
                                            @foreach ($parentcategories as $parent_category)
                                            <option value="{{ $parent_category->id }}">
                                                {{ $parent_category->name }}</option>
                                            @isset($parent_category->childrenCategories)
                                            @php
                                            $parent_loop_index = $loop->index + 1;
                                            @endphp
                                            @foreach ($parent_category->childrenCategories as $child)
                                            @include('website::admin.layouts.modules.post.filterCategory',
                                            ['child' =>
                                            $child,'parent_loop_index'
                                            => $parent_loop_index,'model' => $model ?? null])
                                            @endforeach
                                            @endisset
                                            @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <br>
                                    {{-- Filter --}}
                                    <div class="btn-group p-1" role="group">
                                        <button class="btn btn-primary btn-air-primary dropdown-toggle"
                                            id="customFilter" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i>
                                            Duration Filter</button>
                                        <div class="dropdown-menu" aria-labelledby="customFilter">
                                            <button class="dropdown-item" wire:click="allPosts">All Posts</button>
                                            <button class="dropdown-item" wire:click="todayPosts">Today's
                                                Posts</button>
                                            <button class="dropdown-item" wire:click="weekPosts">This Week's
                                                Posts</button>
                                            <button class="dropdown-item" wire:click="monthPosts">This Month's
                                                Posts</button>
                                            <button class="dropdown-item" wire:click="yearPosts">This Year's
                                                Posts</button>
                                        </div>
                                    </div>
                                    {{-- Status Filter --}}
                                    <div class="btn-group p-1" role="group">
                                        <button class="btn btn-secondary btn-air-secondary dropdown-toggle"
                                            id="customFilter" type="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i>
                                            Status Filter</button>
                                        <div class="dropdown-menu" aria-labelledby="customFilter">
                                            <button class="dropdown-item" wire:click="publishedPosts">Published</button>
                                            <button class="dropdown-item" wire:click="pendingPosts">Pending
                                                Posts</button>
                                            <button class="dropdown-item" wire:click="featuredPosts">Featured
                                                Posts</button>
                                            <button class="dropdown-item" wire:click="orderByPriority">Order By
                                                Priority</button>
                                        </div>
                                    </div>
                                    {{-- Author Filter --}}
                                    <div class="btn-group p-1" role="group">
                                        <button class="btn btn-info btn-air-info dropdown-toggle" id="customFilter"
                                            type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="fa fa-user"></i>
                                            Author Filter</button>
                                        <div class="dropdown-menu" aria-labelledby="customFilter">
                                            @foreach ($authors as $author)
                                            <button class="dropdown-item" wire:click="authorPosts({{ $author->id }})"
                                                wire:key="author{{ $author->id }}">{{ $author->name }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            {{-- Daterangepicker --}}
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="daterange" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                <input type="text" wire:model.debounce.500ms="search"
                                                    class="form-control" placeholder="Search .... ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div wire:ignore wire:loading.flex>
                                    <div style="width:100%;align-items: center;justify-content: center;">
                                        <div class="loader-box" style="margin:auto">
                                            <div class="loader-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:loading.remove>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width: 100%;overflow:x:auto">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Image</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            @hasRole('admin|moderator')
                                            <th>Status</th>
                                            <th>Featured</th>
                                            <th>Priority</th>
                                            @endhasRole
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($posts)
                                        @if ($posts->count() > 0)
                                        @foreach ($posts as $post)
                                        <tr wire:key="{{ $post->id }}">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                @if ($post->image)
                                                <img src="{{ asset($post->thumbnail('image', 'small')) }}"
                                                    alt="{{ $post->name }}" width="60">
                                                @else
                                                <img src="{{ getImagePlaceholder() }}" alt="{{ $post->name }}"
                                                    width="60">
                                                @endif
                                            </td>
                                            <td>{{ $post->author->name ?? 'N/A' }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($post->name, 25) }}
                                            </td>
                                            <div>
                                                @hasRole('admin|moderator')
                                                <td>
                                                    @livewire('admin.post.post-status', ['post' => $post],
                                                    key(time().$post->id))
                                                </td>
                                                <td>
                                                    @livewire('admin.post.post-featured', ['post' => $post],
                                                    key(time().$post->id))
                                                </td>
                                                <td>
                                                    @livewire('admin.post.post-priority', ['post' => $post],
                                                    key(time().$post->id))
                                                </td>
                                                @endhasRole
                                            </div>
                                            <td>
                                                <x-adminetic-action :model="$post" route="post" />
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Image</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            @hasRole('admin|moderator')
                                            <th>Publish</th>
                                            <th>Featured</th>
                                            <th>Priority</th>
                                            @endhasRole
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    @push('livewire_third_party')
    <script>
        $(function() {
                initializeTable();
                Livewire.on('initialize_posts_table', function() {
                    initializeTable();
                });

                function initializeTable() {
                   $('#daterange').daterangepicker({
                       parentEl: '#filter_section',
                        showDropdowns: true,
                        locale: {
                        format: 'YYYY-MM-DD'
                    }
                    });

                    $('#daterange').on('change', function() {
                        var start_date = formattedDay(new Date($('#daterange').data('daterangepicker').startDate));
                        var end_date = formattedDay(new Date($('#daterange').data('daterangepicker').endDate));
                        window.livewire.emit('date_range_filter', start_date, end_date)
                    });
                }

                  // Date Time with Format
		           function formattedDay(date)
		           {
		           var dd = String(date.getDate()).padStart(2, '0');
		           var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
		           var yyyy = date.getFullYear();
		           var h = String(date.getHours());
		           var m = String(date.getMinutes());
		           
		           date = yyyy + '/' + mm + '/' + dd + ' ' + h + ':' + m;
		           return date;
		           }
            });

    </script>
    @endpush
</div>