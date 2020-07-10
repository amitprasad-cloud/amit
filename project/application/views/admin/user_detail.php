<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?=base_url()?>admin/dashboard">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">User Detail</li>
  </ol>

  <!-- Page Content -->
  <p>This is User and His Friends  Detail
    <button class="btn btn-success float-right"><a href="<?=base_url()?>admin/users" style="color:white;">Back</a></button>
  </p>
  <hr>
  <h6>User</h6>
   <table class="table table-bordered"  width="100%" cellspacing="0">
    <thead>
      <tr>
         <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Guest No.</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=$users[0]['firstname']?></td>
        <td><?=$users[0]['lastname']?></td>
        <td><?=$users[0]['email']?></td>
        <td><?=$users[0]['guestcount']?></td>
      </tr>
    </tbody>
  </table>
   <table class="table table-bordered"  width="100%" cellspacing="0">
    <tbody>
      <tr>
        
        <th>Special Offer</th>
        <td><?=(!empty($users[0]['special_code']))?implode(' , ',$users[0]['special_code']):'No special offer'?></td>
      </tr>
  </table>
  <hr>
  <h6>Freinds</h6>
   <?php if(count($friends)>0){ ?>
   <table class="table table-bordered"  width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($friends as $friend){ ?>
      <tr>
        <td><?=$friend['firstname']?></td>
        <td><?=$friend['lastname']?></td>
        <td><?=$friend['email']?></td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
   <p>This user has no friend</p>
<?php } ?>
</div>
<!-- /.container-fluid -->