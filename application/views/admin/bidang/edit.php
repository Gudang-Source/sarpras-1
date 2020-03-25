<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
     <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->   
        <div class="row-fluid">
           <div class="span12">
              <br>
              <?php echo $this->breadcrumb->output();?>
           </div>
        </div>
            
          <div class="row-fluid">
                <div class="span8">
                <?php echo br(1); ?>
                <?php
                $data=$this->session->flashdata('sukses');
                if ($data!=null){?>
                    <div class="alert alert-block alert-success fade in">
                      <p>
                          <strong>Sukses!</strong>  <?php echo $data; ?>
                      </p>
                    </div>
                <?php
                }       
                $data2=$this->session->flashdata('error');
                if ($data2!=null){?>
                     <div class="alert alert-block alert-danger fade in">
                      <p>
                          <strong>Error!</strong> <?php echo $data2; ?>
                      </p>
                    </div>
                <?php
                }       
                ?>
                <div class="widget red">
                    <div class="widget-title">
                        <h4><i class="icon-book"></i> Edit Bidang</h4>
                    </div>
                    <form action="<?php echo site_url('bidang/update'); ?>" method="post">
                      <div class="widget-body">
                          <div class="control-group">
                              <div class="row">
                                   <label class="span1"></label>
                                   <label class="span3">ID Bidang</label>
                                  <div class="span8">
                                      <div class="controls">
                                          <input type="text" readonly value="<?php echo $row['id_bidang']; ?>" required class="span12" name="id_bidang">
                                      </div>  
                                  </div>
                              </div>
                              <div class="row">
                                   <label class="span1"></label>
                                   <label class="span3">Nama Bidang</label>
                                  <div class="span8">
                                      <div class="controls">
                                          <input type="text" autocomplete="off" required value="<?php echo $row['nama_bidang']; ?>" class="span12" name="nama_bidang">
                                      </div>  
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-actions">
                          <center><button class="btn btn-warning"><i class="icon-edit"></i> Edit</button></center>
                      </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
     <!-- END PAGE CONTAINER-->
</div>