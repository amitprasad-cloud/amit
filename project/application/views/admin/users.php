<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>admin/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Users</li>
  </ol>

  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Data Table Example</div>
    <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Guest No</th>
              <th>Special offer</th>
              <th>View Detail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($users as $user){ ?>
            <tr>
              <td><?=$user['firstname']?> <?=$user['lastname']?></td>
              <td><?=$user['email']?></td>
              <td><?=$user['guestcount']?></td>
              <td><?=($user['specialoffer'] !='')?'Yes':'No'?></td>
              <td><button class="btn btn-info"><a href="<?=base_url()?>admin/user_detail/<?=$user['id']?>" style="color:white;">View</a></button></td>
            </tr>
           <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">
      <?php if(isset($user['createddate'])){?>
      Updated yesterday at <?=date('h:i:s a', strtotime($user['createddate']))?> on <?=date('m/d/Y', strtotime($user['createddate']))?>
       <?php } else{ echo "no update"; }?> 
      </div>
  </div>

  

</div>
<!-- /.container-fluid -->
