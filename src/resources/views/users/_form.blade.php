<div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          
          <div class="card">
            <div class="card-header pb-0">
            <div class="d-flex align-items-center">
                <p class="mb-0">Create new Role</p>
                <a class="btn btn-primary btn-sm ms-auto" href="{{ route('users.create') }}">New User</a>
              </div>
              <div class="card-body">
              @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              <form method="POST" action="{{ $url }}">
                @csrf
                @if($user->exists)
                  @method('PUT')
                @endif
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Name *</label>
                    <input class="form-control" name="name" type="text" value="{{ old('name', $user->name) }}">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Email *</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Roles</label>
                    <select class="form-control" multiple name="roles[]">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @if($user->hasRole($role)) selected="selected" @endif>{{ ucfirst($role) }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group form-check form-check-info text-start">
                  <label for="example-text-input" class="form-check-label">Active?</label>
                    <input class="form-check-input" type="checkbox" value="1" name="is_active" @if($user->is_active) checked="checked" @endif />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Password</label>
                    <input class="form-control" name="password" type="text" value="">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Retype Password</label>
                    <input class="form-control" name="retype_password" type="text" value="">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <input class="btn btn-primary" type="submit" value="Save">
                  </div>
                </div>
              </div>
            </form>
            
              <hr class="horizontal dark">
              
            </div>
        </div>
</div>
          
        </div>
      </div>
</div>  