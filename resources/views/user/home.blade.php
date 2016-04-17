@extends('user')

@section('content')
<div class="row">
    <div class="col-md-offset-4 col-md-4 row">
        <div class="col-xs-12 visible-xs visible-sm">&nbsp;</div> 
        @yield('index.submenu')
    </div>
</div>
<h4>
</h4>
<div class="row">
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua" style="background: url('/backend/dist/img/photo1.png') center center;">
          <h3 class="widget-user-username">Elizabeth Pierce</h3>
          <h5 class="widget-user-desc">Web Designer</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle" src="/backend/dist/img/user3-128x128.jpg" alt="User Avatar">
        </div>
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">3,200</h5>
                <span class="description-text">Artikel</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">13,000</h5>
                <span class="description-text">Dilihat</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <div class="box-body">
          <p class="text-center">
              <a class="btn btn-danger" href="#"><i class="fa fa-facebook"></i></a>
              <a class="btn btn-danger" href="#"><i class="fa fa-twitter"></i></a>
              <a class="btn btn-danger" href="#"><i class="fa fa-github"></i></a>
              <a class="btn btn-danger" href="#"><i class="fa fa-google-plus"></i></a>
          </p>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-pencil margin-r-5"></i> Tentang Saya</strong>
          <p class="text-muted">
            B.S. in Computer Science from the University of Tennessee at Knoxville
          </p>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.widget-user -->

    </div>
    <!-- /.col -->
    <div class="col-md-8">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab">Setting</a></li>
        </ul>
        <div class="tab-content">

          <div class="tab-pane active" id="settings">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                <div class="col-sm-10">
                  <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
@stop