

<style>
/*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
/* Desktop Navigation */
.nav-menu ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav-menu > ul {
  display: flex;
}

.nav-menu > ul > li {
  position: relative;
  white-space: nowrap;
  padding: 10px 0 10px 28px;
  margin:auto;
}

h6{
  text-align:right;;
}

.nav-menu a {
  display: block;
  position: relative;
  text-align:right;
  color: #fff;
  transition: 0.3s;
  font-size: 12px;
  font-family: "Montserrat", sans-serif;
  text-transform: uppercase;
  font-weight: 600;
}

.nav-menu a:hover, .nav-menu .active > a, .nav-menu li:hover > a {
  color: #ae3c33;
}

.nav-menu .drop-down ul {
  display: block;
  position: absolute;
  left: 14px;
  top: calc(100% + 30px);
  z-index: 99;
  opacity: 0;
  visibility: hidden;
  padding: 10px 0;
  background: #fff;
  box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
  transition: 0.3s;
}

.nav-menu .drop-down:hover > ul {
  opacity: 1;
  top: 100%;
  visibility: visible;
}

.nav-menu .drop-down li {
  min-width: 180px;
  position: relative;
}

.nav-menu .drop-down ul a {
  padding: 10px 20px;
  font-size: 13px;
  text-transform: none;
  color: #333333;
}

.nav-menu .drop-down ul a:hover, .nav-menu .drop-down ul .active > a, .nav-menu .drop-down ul li:hover > a {
  color: #18d26e;
}

.nav-menu .drop-down > a:after {
  content: "\ea99";
  font-family: IcoFont;
  padding-left: 5px;
}

.nav-menu .drop-down .drop-down ul {
  top: 0;
  left: calc(100% - 30px);
}

.nav-menu .drop-down .drop-down:hover > ul {
  opacity: 1;
  top: 0;
  left: 100%;
}

.nav-menu .drop-down .drop-down > a {
  padding-right: 35px;
}

.nav-menu .drop-down .drop-down > a:after {
  content: "\eaa0";
  font-family: IcoFont;
  position: absolute;
  right: 15px;
}

@media (max-width: 1366px) {
  .nav-menu .drop-down .drop-down ul {
    left: -90%;
  }
  .nav-menu .drop-down .drop-down:hover > ul {
    left: -100%;
  }
  .nav-menu .drop-down .drop-down > a:after {
    content: "\ea9d";
  }
}
.dropdown {
    position: relative;
    display: inline-block;
    
  
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: transparent;
    min-width: 70px;
    z-index: 99;
    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    margin: auto;
  }

  .dropdown-content ul a {
    color: white;
    padding: 10px 10px;
    text-decoration: none;
    
  }
  .nav-menu .dropdown-content li {
  min-width: 50px;
 
}

  .dropdown-content a:hover {
    background-color: #000;
  }

  .dropdown:hover .dropdown-content {
    display: block;
    
  }
</style>
<header>
<nav class="nav-menu d-none d-lg-block" style="font-size:100px">
            <ul>
                  <li><a href="index.php"><h6>Home</h6></a></li>
                  <li><a href="index.php"><h6>All Books</h6></a></li>
                  <li><a href="viewbookings.php"><h6>My Bookings</h6></a></li>
                  <li > <h6 class="animate__animated animate__fadeInDown" style="color: #fff; margin: auto;"> 
                
              <li>
                  <div class="dropdown">
                    <img src="images/person.png" alt="user logo" style="width: 50px; border-radius: 50%;">
                    <div class="dropdown-content">
                      <?php
                      if($_SESSION['role'] == 0){
                        echo '
                        <ul> 
                        <li> <a href="../Admin/frontend/index.php"> Admin Dash</a> </li>
                        </ul>' ;
                      }?>
                      <ul> 
                        <li> <a href="logout.php">Logout</a> </li>
                      </ul>
                    </div>
                  </div>
              </li>
            </ul>
          </nav></header>