@extends('layouts.app-admin', ['title' => 'Blog Tags'])

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>Blog Tags&nbsp;<span class="badge badge-pill badge-primary">{{ number_format($tags->total(), 0, '', '.') }}</span>
                        <div class="page-title-subheading">List Blog Tags</div>
                    </div>
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
                            {{-- <th style="min-width: 100px">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tags->count() == 0)
                            <tr>
                                <td colspan="5">No tags to display.</td>
                            </tr>
                        @endif
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->tag_name ? $tag->tag_name : '-' }}</td>
                                <td>{{ $tag->slug ? $tag->slug : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 col-md-6 flex-1">
                        {!! $tags->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                    </div>
                    <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                        <p>Displaying {{ $tags->count() }} of {{ number_format($tags->total(), 0, '', '.') }} tags</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
