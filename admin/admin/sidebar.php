<style>
  .sidebar .sidebar-help-button {
    width: 130px;
    height: 35px;
    line-height: 35px;
    border-radius: 20px;
    background: #1a3d5d;
    display: inline-block;
    font-size: 13px;
    text-transform: uppercase;
    color: #d9dde1;
    letter-spacing: .5px;
    font-weight: 700;
    -webkit-box-shadow: 0 5px 6px rgba(0,0,0,.05);
    box-shadow: 0 5px 6px rgba(0,0,0,.05);
    position: relative;
    padding: 0 15px;
    text-align: right;
    -o-transition: all .3s;
    transition: all .3s;
    -webkit-transition: all .3s;
    -ms-transform: translateY(-55px);
    transform: translateY(-55px);
    -webkit-transform: translateY(-55px);
}
</style>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
      <div class="app-sidebar__user">
		    <i class='fa fa-user fa-lg text-light'></i>

        <div>
          <p class="app-sidebar__user-name ml-1"> 

            Hi, <?php 
              if(substr($fullname,0,strpos($fullname,' ')) !=''){
                echo substr($fullname,0,strpos($fullname,' ')); 
              }else{
                echo $fullname;
              } 
            ?>
          
          </p>
        
        </div>
      </div>
      <ul class="app-menu" style="font-size:13px;">
          
           
		
        <li>
          <a class="app-menu__item" href="index.php" id="dashboard">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        
        <li>
			<a class="app-menu__item" href="manageproduction.php" id="sitecms">
				<i class="app-menu__icon fa fa-th-list"></i>
				<span class="app-menu__label">Manage Production</span>
			</a>
		</li>
        
        <li>
           <a class="app-menu__item" href="manageexpenses.php" id="allcustomers">
              <i class="app-menu__icon fa fa-pie-chart"></i>
              <span class="app-menu__label">Manage Expenses</span>
            </a>
        </li>

        <li>
          <a class="app-menu__item" href="managesales.php" id="managesales">
            <i class="app-menu__icon fa fa-pie-chart"></i>
            <span class="app-menu__label">Manage Sales</span>
          </a>
        </li>

        <li>
         <a class="app-menu__item" href="managerm.php" id="managerm">
           <i class="app-menu__icon fa fa fa-laptop"></i>
           <span class="app-menu__label">Manage Raw Materials</span>
         </a>
        </li>
        
        <li>
          <a class="app-menu__item" href="managecustomers.php" id="manageprogramme">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Manage Customers</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item" href="viewdebtors.php" id="viewdebtors">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">View Debtors</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item" href="managefrontpayment.php" id="manageprogramme">
            <i class="app-menu__icon fa fa-laptop"></i>
            <span class="app-menu__label">Manage Up-Front Payments</span>
          </a>
        </li>

        <li>
			<a class="app-menu__item" href="manageinvoices.php" id="manageinvoices">
				<i class="app-menu__icon fa fa-th-list"></i>
				<span class="app-menu__label">Manage Invoices</span>
			</a>
		</li>
    <li>
			<a class="app-menu__item" href="changepassword.php" id="changepassword">
				<i class="app-menu__icon fa fa-th-list"></i>
				<span class="app-menu__label">Production Estimation</span>
			</a>
		</li>
        
      <li>
         <a class="app-menu__item" href="editcustomeracct.php" id="composemail">
           <i class="app-menu__icon fa fa-edit"></i>
           <span class="app-menu__label">Damage Accounting</span>
         </a>
     </li> 

      </ul>
</aside>