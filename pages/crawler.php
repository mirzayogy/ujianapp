<?php
require_once('plugins/twitter-api/config.php');
require_once('assets/lib/connection.php');

$kata_kunci = '';
if (isset($_POST['kata-kunci'])){
  $kata_kunci = $_POST['kata-kunci'];
  $jumlah = $_POST['banyak-data'];
  $no = 0;
  $query = array(
    "q" => $kata_kunci,
    "count" => $jumlah
  );
  $results = search($query);
  // print_r($results);
}
?>

<div class="block-header">
  <h2>ABOUT</h2>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          BASIC EXAMPLE
        </h2>
        <ul class="header-dropdown m-r--5">
          <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">more_vert</i>
            </a>
            <ul class="dropdown-menu pull-right">
              <li><a href="javascript:void(0);">Action</a></li>
              <li><a href="javascript:void(0);">Another action</a></li>
              <li><a href="javascript:void(0);">Something else here</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="body">
        <form method="post">
          <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
              <div class="form-group form-float">
                <div class="form-line">
                  <select class="form-control show-tick" name="kata-kunci">
                      <option value="">-- Please select --</option>
                      <option value="jakarta banjir" <?php if($kata_kunci=="jakarta banjir") echo "selected" ?>>Jakarta Banjir</option>
                      <option value="jakarta macet"  <?php if($kata_kunci=="jakarta macet") echo "selected" ?>>Jakarta Macet</option>
                      <option value="anies"          <?php if($kata_kunci=="anies") echo "selected" ?>>Anies</option>
                      <option value="anies baswedan" <?php if($kata_kunci=="anies baswedan") echo "selected" ?>>Anies Baswedan</option>
                      <option value="ganjar"         <?php if($kata_kunci=="ganjar") echo "selected" ?>>Ganjar</option>
                      <option value="ganjar pranowo" <?php if($kata_kunci=="ganjar pranowo") echo "selected" ?>>Ganjar Pranowo</option>
                      <option value="ridwan kamil"   <?php if($kata_kunci=="ridwan kamil") echo "selected" ?>>Ridwan Kamil</option>
                      <option value="gubernur"       <?php if($kata_kunci=="gubernur") echo "selected" ?>>Gubernur</option>
                      <option value="bupati"         <?php if($kata_kunci=="bupati") echo "selected" ?>>Bupati</option>
                      <option value="walikota"       <?php if($kata_kunci=="walikota") echo "selected" ?>>Walikota</option>
                      <option value="presiden"       <?php if($kata_kunci=="presiden") echo "selected" ?>>Presiden</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="number" class="form-control" name="banyak-data" value="100">
                  <label class="form-label">Banyak Data</label>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <!-- <input type="checkbox" id="remember_me_5" class="filled-in">
              <label for="remember_me_5">Remember Me</label> -->
              <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="cari">CARI</button>
              <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"name="simpan">CARI & SIMPAN</button>
            </div>
          </div>
        </form>
        <form method="post">
          <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="text" class="form-control" name="kata-kunci">
                  <label class="form-label">Kata Kunci</label>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
              <div class="form-group form-float">
                <div class="form-line">
                  <input type="number" class="form-control" name="banyak-data" value="100">
                  <label class="form-label">Banyak Data</label>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <!-- <input type="checkbox" id="remember_me_5" class="filled-in">
              <label for="remember_me_5">Remember Me</label> -->
              <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect" name="cari">CARI</button>
              <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"name="simpan">CARI & SIMPAN</button>
            </div>
          </div>
        </form>
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="js-basic-example">
            <thead>
              <tr>
                <th width="4%">No</th>
                <th width="16%">User</th>
                <th width="80%">Tweet</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>User</th>
                <th>Tweet</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              if(!empty($results)){
                $database = new Database();
                $db = $database->getConnection();
                // print_r($results->statuses);
                foreach ($results ->statuses as $result) {
                  // date_default_timezone_set('Asia/Makassar');
                  //
                  $datetime = new DateTime($result->created_at);
                  $timezone = new DateTimeZone('Asia/Makassar');
                  $datetime->setTimeZone($timezone);

                  $no++;
                  $keywords = $kata_kunci;
                  $screen_name = $result->user->screen_name;
                  $avatar = $result->user->profile_image_url;
                  $text = $result->text;
                  $followers_count = $result->user->followers_count;
                  $friends_count = $result->user->friends_count;
                  $description = $result->user->description;

                  // echo "<tr class='text-sm'>";
                  // 	echo "<td>" . $no . "</td>";
                  // 	echo "<td style='text-align:center'>" . "<img style='margin-bottom:5px; width:40px; height:40px;' class='img-circle img-border' src= " . $avatar .  "><br><span class='user-info'>" . $username . "</span>" . "</td>";
                  // 	echo "<td>" . $result->text . "</td>";
                  // echo "</tr>";
                  echo "<tr class='text-sm'>";
                  echo "<td style='text-align:center'>" . $no . "</td>";
                  echo "<td style='text-align:left'><span class='user-info'>" . $screen_name . "</span>" . "</td>";
                  echo "<td>" . $text . "</td>";
                  echo "</tr>";

                  if (isset($_POST['simpan'])) {
                    $query = "INSERT INTO twit SET
                      keywords =:keywords,
                      screen_name =:screen_name,
                      text =:text,
                      followers_count =:followers_count,
                      friends_count =:friends_count,
                      description =:description";
                    $stmt = $db->prepare($query);

                    $keywords=htmlspecialchars(strip_tags($keywords));
                    $screen_name=htmlspecialchars(strip_tags($screen_name));
                    $text=htmlspecialchars(strip_tags($text));
                    $followers_count=htmlspecialchars(strip_tags($followers_count));
                    $friends_count=htmlspecialchars(strip_tags($friends_count));
                    $description=htmlspecialchars(strip_tags($description));

                    $stmt->bindParam(":keywords", $keywords);
                    $stmt->bindParam(":screen_name", $screen_name);
                    $stmt->bindParam(":text", $text);
                    $stmt->bindParam(":followers_count", $followers_count);
                    $stmt->bindParam(":friends_count", $friends_count);
                    $stmt->bindParam(":description", $description);
                    $stmt->execute();
                  }
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
<div class="btn-group btn-group-lg dropup floating-action-button">
<button type="button" class="btn btn-info btn-fab btn-raised dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">save</i>
</button>
<ul class="dropdown-menu dropdown-menu-right">
  <li><a href="#" class="btn btn-danger btn-fab btn-raised"><i class="material-icons">clear</i></a>
  </li>
</ul>
</div>
