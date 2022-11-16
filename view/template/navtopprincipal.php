<? 
include("view/template/head.php");
?>
<script type="text/javascript" >
    const zeroFill = n => {
        return ("0" + n).slice(-2);
    }
    const interval = setInterval(() => {
        const now = new Date();
        const dateTime = "  " + zeroFill(now.getUTCDate()) + "/" + zeroFill((now.getMonth() + 1)) + "/" + now
            .getFullYear() + " " + zeroFill(now.getHours()) + ":" + zeroFill(now.getMinutes()) + ":" + zeroFill(now
                .getSeconds());
        document.getElementById("date-time").innerHTML = dateTime;
    }, 0500);
    </script>
    <style>
    a#menus {
        border-bottom: 2px solid transparent;
    }

    a#menus:hover {
        border-bottom: 2px solid black;
    }

    a#menubrand {
        border-bottom: 2px solid transparent;
    }
    </style>
    <nav id="navtop" class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top"
        style="z-index:10000; width: 100%;">
        <div
            style="margin:0 auto;display: flex;justify-content: space-around;flex-wrap: wrap;align-content: stretch;align-items: center; width:95%;">
            <a class="navbar-brand" id="menubrand" href="#">
                <?echo _('storename').' - ' . _('adewmplus')?>
            </a>
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation" style="margin:0 auto;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mb-1" id="collapsibleNavId">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a id="menus" class="nav-link" href="../manager/webmanager.php" aria-current="page">
                            <? echo _('home')?>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="menus" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            <? echo _('productrelated')?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../products/products.php">
                                    <? echo _('advancedproductinfo')?>
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="../products/classtypes.php">
                                    <? echo _('productclassesandtypes')?>
                                </a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="menus" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">
                            <? echo _('taxesanddiscounts')?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../taxes/taxes.php">
                                    <? echo _('taxes')?>
                                </a></li>
                            <li><a class="dropdown-item" href="../vouchers/vouchers.php">
                                    <? echo _('discountvouchers')?>
                                </a>
                            </li>
                        </ul>
                    </li>
<?
    if ($_SESSION['userisadmin'] === true) {?>
        
               <li class="nav-item dropdown">
                        <a id="menus" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false"><? echo _('advsetts')?></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../advanced/users.php"><? echo _('usernavtop')?></a></li>
                            <li><a class="dropdown-item" href="../advanced/invoicesearch.php"><? echo _('invoicestop')?></a></li>
                            <li><a class="dropdown-item" href="../advanced/langchange.php"><? echo _('language')?></a></li>
                        </ul>
                    </li>
               <?
    } else {
    };?>
    </ul>
            </div>

            <div>
                <a href="../advanced/profile.php"><button type="button" class="btn btn-warning"><i
                            class="bi bi-person-fill"></i>
                       <? echo _('sessionrealname')?>
                    </button></a>
                <a href="../login/logout.php"><button type="button" class="btn btn-warning"><i class="bi bi-upload"></i>
                        <? echo _('logout')?>
                    </button></a>
                <button type="button" class="btn btn-dark"><i class="bi bi-clock"></i><span id="date-time">
                        <p>--/--/---- --:--:--</p>
                    </span></button>
          <?      
    if ($administrator === true) {?>
       <a href="../advanced/langchange.php"><button type="button" class="btn btn-dark"><i class="bi bi-translate"></i><? echo '  ' . _('locale')?></button></a>
    <?} else {?>
        <button type="button" class="btn btn-dark"><i class="bi bi-translate"></i><? echo '  ' . _('locale')?></button>
    <?}?>
    
            </div>
        </div>
    </nav>