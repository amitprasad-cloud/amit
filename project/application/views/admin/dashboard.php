<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>admin/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Overview</li>
  </ol>

  <!-- Icon Cards-->
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-primary o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-comments"></i>
          </div>
          <div class="mr-5">Total Uers: <br><?=$usercount?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="<?=base_url()?>admin/users">
          <span class="float-left">View Details</span>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

 <!-- Sticky Footer -->
<footer class="sticky-footer">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright © Your Website 2020</span>
    </div>
  </div>
</footer>