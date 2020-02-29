<aside id="leftsidebar" class="sidebar">
  <!-- User Info -->
  <div class="user-info">
    <div class="image">
      <img src="assets/images/user.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
      <div class="email">john.doe@example.com</div>
      <div class="btn-group user-helper-dropdown">
        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
        <ul class="dropdown-menu pull-right">
          <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
          <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
          <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- #User Info -->
  <!-- Menu -->
  <?php
  if(!empty($_GET['p'])){
    $page=$_GET['p'];
  }
  else {
    $page = "";
  }
  ?>

  <div class="menu">
    <ul class="list">
      <li class="header">MAIN NAVIGATION</li>
      <li <?php if($page=="home" || $page=="") echo 'class="active"'; ?>>
        <a href="home">
          <i class="material-icons">home</i>
          <span>Home</span>
        </a>
      </li>
      <li <?php if($page=="crawler") echo 'class="active"'; ?>>
        <a href="crawler">
          <i class="material-icons">pageview</i>
          <span>Crawler</span>
        </a>
      </li>
      <li id="li_input">
        <a href="input">
          <i class="material-icons">input</i>
          <span>Input</span>
        </a>
      </li>
      <li id="li_test">
        <a href="#test">
          <i class="material-icons">assignment</i>
          <span>Test</span>
        </a>
      </li>
      <li <?php
      if(
        $page=="programstudi" || $page=="programstudicreate" || $page=="programstudiupdate" ||
        $page=="tahunakademik" || $page=="tahunakademikcreate" || $page=="tahunakademikupdate"
      ) {
        echo 'class="active"';
      }?>
      >
      <a href="javascript:void(0);" class="menu-toggle">
        <i class="material-icons">widgets</i>
        <span>Masters</span>
      </a>
      <ul class="ml-menu">
        <li
        <?php
        if($page=="tahunakademik" || $page=="tahunakademikcreate" || $page=="tahunakademikupdate") {
          echo 'class="active"';
        }?>
        >
          <a href="tahunakademik">Tahun Akademik</a>
        </li>
        <li
        <?php
        if($page=="programstudi" || $page=="programstudicreate" || $page=="programstudiupdate") {
          echo 'class="active"';
        }?>
        >
        <a href="programstudi">Program Studi</a>
      </li>
      <li>
        <a href="pages/widgets/cards/colored.html">Mata Kuliah</a>
      </li>
      <li>
        <a href="javascript:void(0);" class="menu-toggle">
          <span>Cards</span>
        </a>
        <ul class="ml-menu">
          <li>
            <a href="pages/widgets/cards/no-header.html">Tahun Akademik</a>
          </li>
          <li>
            <a href="pages/widgets/cards/basic.html">Program Studi</a>
          </li>
          <li>
            <a href="pages/widgets/cards/colored.html">Mata Kuliah</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="javascript:void(0);" class="menu-toggle">
          <span>Infobox</span>
        </a>
        <ul class="ml-menu">
          <li>
            <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
          </li>
          <li>
            <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
          </li>
          <li>
            <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
          </li>
          <li>
            <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
          </li>
          <li>
            <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
  <div class="copyright">
    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
  </div>
  <div class="version">
    <b>Version: </b> 1.0.5
  </div>
</div>
<!-- #Footer -->
</aside>
