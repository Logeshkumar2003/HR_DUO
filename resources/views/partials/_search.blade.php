<div class="jobs-search-box">
    <form method="GET" action="/jobs">
        <div class="row align-items-center">
            <div class="col-lg-9 col-md-8 col-sm-12 mb-3 mb-md-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 25px 0 0 25px; border-color: #ddd;">
                            <i class="fa fa-search text-muted"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control border-left-0" style="border-radius: 0 25px 25px 0;" name="search" value="{{ request('search') }}" placeholder="Search by job title, description, or keyword..." />
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <button class="btn btn-search" type="submit">
                    <i class="fa fa-search mr-1"></i> Search Jobs
                </button>
            </div>
        </div>
        @if(request('tag') || request('search'))
        <div class="row mt-3">
            <div class="col-12">
                <span class="text-muted mr-2" style="font-size: 14px;">Active Filters:</span>
                @if(request('search'))
                    <span class="badge badge-light border p-2 mr-1">
                        Search: "<strong>{{ request('search') }}</strong>"
                        <a href="/jobs{{ request('tag') ? '?tag=' . request('tag') : '' }}" class="text-danger ml-1">&times;</a>
                    </span>
                @endif
                @if(request('tag'))
                    <span class="badge badge-light border p-2 mr-1">
                        Tag: "<strong>{{ request('tag') }}</strong>"
                        <a href="/jobs{{ request('search') ? '?search=' . request('search') : '' }}" class="text-danger ml-1">&times;</a>
                    </span>
                @endif
                <a href="/jobs" class="text-muted ml-2" style="font-size: 13px; text-decoration: underline;">Clear all filters</a>
            </div>
        </div>
        @endif
    </form>
</div>
