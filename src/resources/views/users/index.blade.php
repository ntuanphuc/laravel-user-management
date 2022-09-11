@extends('spum::layouts.app')

@section('content')
<div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          
          <div class="card">
            <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">Filter Users</p>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('users.create') }}">New User</a>
              </div>
              <div class="card-body">
              <form>
                @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    
                    <input class="form-control" name="keyword" type="text" value="{{ old('keyword', $keyword) }}">
                  </div>
                </div>
                <div class="col-md-6">

                  <input class="btn btn-primary" type="submit" value="Search">
                </div>
              </div>
            
              
              <hr class="horizontal dark">
</form>
            </div>
        </div>
</div>
          
        </div>
      </div>
</div>  
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Users List</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                
              <div class="table-responsive p-0">
              @if(count($users))
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Roles</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $user->getRoleNames() }}</p>
                        
                      </td>
                      <td class="align-middle text-center text-sm">
                        
                        <span class="badge badge-sm bg-gradient-{{ ($user->is_active) ? 'success' : 'secondary' }}">{{ ($user->is_active) ? 'Active' : 'Inactive' }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                      </td>
                      <td class="align-middle">
                        <a href="{{ route('users.edit', $user) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @else
                <div class="col-md-12">
                  No User found
                </div>
                @endif
              </div>
              
            </div>
        </div>
      </div>
  </div>
</div>


@endsection
