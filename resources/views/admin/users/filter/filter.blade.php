<div class="card-body">
    <form action="{{url()->current()}}" method="GET">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="sort_by">
                        <option value="" selected disabled>Sort By</option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="created_at">Created At</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="order_by">
                        <option value="" selected disabled>Order By</option>
                        <option value="asc">Asc</option>
                        <option value="desc">Desc</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="limit_by">
                        <option value="" selected disabled>Limit</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="" selected disabled>Status</option>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Enter keyword...">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
