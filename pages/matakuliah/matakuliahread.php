<?php
require_once('plugins/twitter-api/config.php');
require_once('assets/lib/connection.php');

$database = new Database();
$db = $database->getConnection();
?>

<div class="block-header">
  <h2>MATA KULIAH</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          Lihat Data
        </h2>
        <ul class="header-dropdown m-r--5">

          <li class="dropdown">
            <a href="matakuliahcreate" class="btn bg-indigo btn-circle-lg waves-effect waves-circle waves-float" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">add</i>
            </a>
          </li>
        </ul>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
            <thead>
              <tr>
                <th style="width:65px">Opsi</th>
                <th>Program Studi</th>
                <th>SMT</th>
                <th>Mata Kuliah</th>
                <th>Singkatan</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th style="width:65px">Opsi</th>
                <th>Program Studi</th>
                <th>SMT</th>
                <th>Mata Kuliah</th>
                <th>Singkatan</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              $selectQuery = "SELECT m.*,p.prodi FROM matakuliah m LEFT JOIN programstudi p ON m.id_programstudi = p.id ORDER by p.id, m.semester, m.mata_kuliah";
              $stmt = $db->prepare($selectQuery);
              $stmt->execute();
              if($stmt->rowCount()>0){
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  extract($row);
                  ?>
                  <tr style="vertical-align:bottom">
                    <td>
                      <div class="form-row">
                        <form action="matakuliahupdate" method="post">
                          <button class="btn bg-blue btn-xs waves-effect update-button" type="submit" name="update" value="<?php echo $id ?>">
                            <i class="material-icons">edit</i>
                          </button>
                        </form>

                        <button class="btn bg-red btn-xs waves-effect delete-button" type="button" name="delete" data-id="<?php echo $id ?>">
                          <i class="material-icons">delete</i>
                        </button>
                      </div>
                    </td>
                    <td><?php echo $prodi ?></td>
                    <td><?php echo $semester ?></td>
                    <td><?php echo $mata_kuliah ?></td>
                    <td><?php echo $singkatan ?></td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/pages/matakuliah.js"></script>
