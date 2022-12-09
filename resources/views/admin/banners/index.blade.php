@extends('layouts.app-admin', ['title' => 'Blog Category'])

@section('content')
    {{-- <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>Blog Category&nbsp;<span class="badge badge-pill badge-primary">{{ number_format($categories->total(), 0, '', '.') }}</span>
                        <div class="page-title-subheading">List Blog Category</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.blog-category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Blog Category</a>
                </div>
            </div>
        </div>
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12 col-md-5">
                        <div class="d-flex">
                            <form class="form-inline" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-search fa-w-16"></i>
                                        </div>
                                    </div>
                                    <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off" placeholder="Search" type="text" class="form-control" style="color: gray;">
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-primary btn-md">Search</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form-inline" method="GET">
                                <button class="btn btn-light btn-lg ml-2">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <table style="width: 100%;" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="min-width: 120px">@sortablelink('name', 'Name')</th>
                            <th style="min-width: 120px">@sortablelink('slug', 'Slug')</th>
                            <th style="min-width: 120px">Tags</th>
                            <th style="min-width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count() == 0)
                            <tr>
                                <td colspan="5">No categories to display.</td>
                            </tr>
                        @endif
                        @foreach ($categories as $category)
                            @php
                                $tags_id = explode(',', $category->tags_id);
                            @endphp
                            <tr>
                                <td>{{ $category->name ? $category->name : '-' }}</td>
                                <td>{{ $category->slug ? $category->slug : '-' }}</td>
                                <td>
                                    @foreach ($blogtags as $tag)
                                        @if (is_array($tags_id) && in_array($tag->id, $tags_id))
                                            @php
                                                $tagArr[] = $tag->tag_name;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        echo implode(', ', $tagArr);
                                        unset($tagArr);
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('admin.blog-category.edit', $category) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                                    <button type="button" onclick="delete_blog_category({{ $category->id }})" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 flex-1">
                        {!! $categories->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                    </div>
                    <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                        <p>Displaying {{ $categories->count() }} of {{ number_format($categories->total(), 0, '', '.') }} categories</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script type="text/javascript">
        function delete_blog_category(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "DELETE",
                        url: "/blog-category/" + id,
                        data: {
                            _token: _token,
                            id: id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                window.location = "{{ route('admin.blog-category.index') }}";
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection
