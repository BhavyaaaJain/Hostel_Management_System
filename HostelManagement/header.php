
<?php if($_SESSION['id'])
{ ?>
<style>
    #navbar {
    display: flex;
    justify-content: flex-end;
    position: sticky;
    top: 0px;
}

#orgname{
    margin-right: auto;
    padding: 15px;
    /* margin: auto; */
    margin-top: 10px;
    position: relative;
    color: rgb(156 170 188);
}

#navbar ul{
    display: flex;
}

#navbar ul li{
    list-style: none;
    padding: 10px;
    /* padding: 10px 47px 10px 47px; */
    
}

#navbar::before{
    content: "";
    background-color: #1A2226;
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: -2;
    /* opacity: 0.95; */
    
}

#navbar ul li a{
    text-decoration: none;
    color: rgb(156 170 188);
    padding: 10px 47px 10px 47px;
}

#navbar ul li a:hover{
    border: 2px solid  #0DB8DE;
    background-color: #102935;
    box-shadow: 0 0.5em 0.5em -0.4em #0DB8DE var(--hover) ;
    border-radius: 10px;
    transform: translateY(-0.25em);
}
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {background-color: #f1f1f1}
  
  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {
    display: block;
  }
  
  /* Change the background color of the dropdown button when the dropdown content is shown */
  .dropdown:hover .dropbtn {
    background-color: #3e8e41;
  }/* *********HOME************/

</style>
    <nav id="navbar">
        <div id="orgname"> ORGANISATION </div>
        <ul>
            <li class="item"><a href="main_page.php#home">HOME</a></li>
            <li class="item"><a href="main_page.php#services">SERVICES</a></li>
            <li class="item"><a href="main_page.php#about">ABOUT</a></li>
            <li class="item"><a href="main_page.php#contact">CONTACT US</a></li>
            <div class="dropdown"><a href="#account" class="dropbtn">My Account</a>
                <div class="dropdown-content">
                    <a href="admin.php">Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>

        </ul>
    </nav>
    
<?php
} 