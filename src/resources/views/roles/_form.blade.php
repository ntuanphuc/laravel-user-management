<div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          
          <div class="card">
            <div class="card-header pb-0">
            <div class="d-flex align-items-center">
              
              <p class="mb-0">@if($role->exists) Edit @else Create New @endif Role</p>
              
                
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
                @if($role->exists)
                @method('PUT')
                @endif
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Name *</label>
                    <input class="form-control" name="name" type="text" value="{{ old('name', $role->name) }}">
                  </div>
                </div>
                <div class="col-md-6">

                  
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                  <label for="example-text-input" class="form-control-label">Guard</label>
                    <input class="form-control" type="text" name="guard_name" value="{{ old('guard_name', $role->guard_name) }}">
                  </div>
                </div>
                <div class="col-md-6">

                  
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