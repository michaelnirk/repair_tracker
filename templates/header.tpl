<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">          
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Repair Tracker</a>
        </div>
        <div class="collapse navbar-collapse">
            <div class="navbar-right">
              <ul class="navbar-nav nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?module=user&action=logout">Log Out</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Options
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Edit Account</a></li>
                        <li><a href="index.php?module=utility&action=showchangepassword">Change Account Password</a></li>
                        <li><a href="index.php?module=utility&action=create_reminder">Create Account Reminder</a></li>
                    </ul>
                  </li>
              </ul> 
            </div>          
        </div>
    </div>
</nav> 