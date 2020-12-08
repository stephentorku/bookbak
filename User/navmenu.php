
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<style>

.hoverable{
  display:inline-block;
  backface-visibility: hidden;
  vertical-align: middle;
  position:relative;
  box-shadow: 0 0 1px rgba(0,0,0,0);
  tranform: translateZ(0);
  transition-duration: .3s;
  transition-property:transform;
}

.hoverable:before{
  position:absolute;
  pointer-events: none;
  z-index:-1;
  content: '';
  top: 100%;
  left: 5%;
  height:10px;
  width:90%;
  opacity:0;
  background: -webkit-radial-gradient(center, ellipse, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0) 80%);
  background: radial-gradient(ellipse at center, rgba(255, 255, 255, 0.35) 0%, rgba(255, 255, 255, 0) 80%);
  /* W3C */
  transition-duration: 0.3s;
  transition-property: transform, opacity;
}

.hoverable:hover, .hoverable:active, .hoverable:focus{
  transform: translateY(-5px);
}
.hoverable:hover:before, .hoverable:active:before, .hoverable:focus:before{
  opacity: 1;
  transform: translateY(-5px);
}



@keyframes bounce-animation {
  16.65% {
    -webkit-transform: translateY(8px);
    transform: translateY(8px);
  }

  33.3% {
    -webkit-transform: translateY(-6px);
    transform: translateY(-6px);
  }

  49.95% {
    -webkit-transform: translateY(4px);
    transform: translateY(4px);
  }

  66.6% {
    -webkit-transform: translateY(-2px);
    transform: translateY(-2px);
  }

  83.25% {
    -webkit-transform: translateY(1px);
    transform: translateY(1px);
  }

  100% {
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
}

.bounce {
  animation-name: bounce-animation;
  animation-duration: 2s;
}



/*everything below here is just setting up the page, so dont worry about it */


@media (min-width: 768px) {
  .navbar{
    text-align: center !important;
    float: none;
    display: inline-block;
  }
}



nav {
  background: none !important;
  text-transform:uppercase;
  li {
    margin-left: 3em;
    margin-right: 3em;
    a{
      transition: .5s color ease-in-out;
    }
  }
}
.dropdown {
    color: #9d9d9d;
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>
</style>
<script>
$(function(){
  var str = '#len'; //increment by 1 up to 1-nelemnts
  $(document).ready(function(){
    var i, stop;
    i = 1;
    stop = 4; //num elements
    setInterval(function(){
      if (i > stop){
        return;
      }
      $('#len'+(i++)).toggleClass('bounce');
    }, 500)
  });
});
</script>

<div class="container-fluid">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a id="len1" class="hoverable" href="student_view.php" style="color: #9d9d9d; padding-top:15px"> Books</a> </li>
        <li><a id="len2" class="hoverable" href="mybooks.php">My Books</a></li>
        <li><a id="len3" class="hoverable" href="inbox.php">Inbox</a></li>
        <?php
            if($_SESSION['role'] == 0){
            echo '
            <li> <a id="len3" class="hoverable" href="../Admin/frontend/index.php"> Admin Dash</a> </li>' ;
            }
        ?>
        <li><a id="len4" class="hoverable" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
</div>

