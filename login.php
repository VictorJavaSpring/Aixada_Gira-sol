<?php
require_once "php/inc/header.inc.base.php";

require_once __ROOT__ . 'php' . DS . 'inc' . DS . 'authentication.inc.php';

if (!isset($_SESSION)) {
    session_start();
    $_SESSION['aixada'] = true;
    session_commit(); // Force write session to create it and able to open $_SESSION faster.
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= $language ?>" lang="<?= $language ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> <?php print $Text['global_title'] . " - " . $Text['ti_login_news']; ?> </title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/aixada_main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/ui-themes/<?= $default_theme; ?>/jqueryui.css" />


    <script type="text/javascript" src="js/jquery/jquery.js"></script>
    <script type="text/javascript" src="js/jqueryui/jqueryui.js"></script>
    <?php echo aixada_js_src(false); ?>

    <style>
        <?php
        $login_header_image =
            get_config('login_header_image', 'img/aixada_header800.150Girasols.png');
        if ($login_header_image) {
            echo "p#logonHeader {background-image: url({$login_header_image});}";
        } else {
            echo "p#logonHeader {background-image: none;}";
        }
        ?>
        <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />
    </style>



    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                cache: false
            });
            /**
             *    logon stuff
             */
            $('#login').submit(function() {
                var dataSerial = $(this).serialize();
                //alert(dataSerial);
                $.ajax({
                    type: "POST",
                    url: "php/ctrl/Login.php?oper=login",
                    data: dataSerial,
                    success: function() {
                        top.location.href = 'index.php';

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $.updateTips('#logonMsg', 'error', XMLHttpRequest.responseText);

                    }
                }); //end ajax retrieve date
                return false;
            });



            /**
             * forgot pwd dialog
             */
            $('#dialog-recuperatePwd').dialog({
                autoOpen: false,
                buttons: {
                    "<?= $Text['btn_ok']; ?>": function() {
                        $.ajax({
                            type: "POST",
                            url: '',
                            success: function(txt) {

                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                $.showMsg({
                                    msg: XMLHttpRequest.responseText,
                                    type: 'error'
                                });

                            }
                        });


                    },

                    "<?= $Text['btn_close']; ?>": function() {
                        $(this).dialog("close");
                    }
                }
            });



            /**
             *    incidents
             */
            $('#newsWrap').xml2html('init', {
                url: 'php/ctrl/Incidents.php',
                params: 'oper=getIncidentsListing&filter=pastWeek&type=3',
                loadOnInit: true
            });





            /**
             *    reset different intput fields
             */
            $('input').focus(function() {
                $(this).removeClass('ui-state-error');
            });

            $('#login_input, #password').focus(function() {
                $('#logonMsg')
                    .text('')
                    .removeClass('ui-state-error');
            });



        });
    </script>

</head>

<body>


    <div id="wrap">

        <div id="headwrap">
            <p id="logonHeader"><span><?php
                                        if (get_config('login_header_show_name', false)) {
                                            echo $Text['coop_name'];
                                        } ?></span></p>
        </div>

        <div id="stagewrap" class="ui-widget">

            <div class="floatLeft aix-layout-splitW20 aix-layout-widget-left-col hidden">
                <div class="ui-widget-content ui-corner-all">
                    <h4 class="ui-widget-header">Global info</h4>
                </div>
            </div>

            <div class="floatLeft aix-layout-splitW50 aix-layout-widget-center-col">
                <div id="newsWrap">
                    <div class="portalPost">
                        <h2 class="subject">{subject}</h2>
                        <p class="info"><?php echo $Text['posted_by']; ?> {user_name} (<?php echo $Text['uf_short']; ?>{uf_id}), {ts} </p>
                        <p class="msg">{details}</p>
                    </div>
                </div>
            </div>


            <div id="logonWrap" class="aix-layout-splitW20">
                <div class="modern-login-box">
                    <h4 class="modern-login-title"><?php echo $Text['login']; ?></h4>
                    <p id="logonMsg" class="user_tips"></p>
                    <form id="login" method="post" class="modern-login-form">
                        <div class="form-group">
                            <label for="login_input"><?= $Text['logon']; ?></label>
                            <input type="text" name="login" id="login_input" placeholder="<?= $Text['logon']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="password"><?= $Text['pwd']; ?></label>
                            <input type="password" name="password" id="password" placeholder="<?= $Text['pwd']; ?>" autocomplete="current-password" required />
                        </div>
                        <div class="form-actions">
                            <button name="submitted" id="btn_logon" class="modern-btn"><?= $Text['btn_login']; ?></button>
                        </div>
                        <input type="hidden" name="originating_uri" value="<?= (isset($_REQUEST['originating_uri']) ? $_REQUEST['originating_uri'] : 'login.php') ?>">
                    </form>
                </div>
            </div><!-- end logonwrap -->



        </div><!-- end stagewrap -->



    </div>
    <div id="dialog-message" title="">
        <p class="minPadding ui-corner-all"></p>
    </div>
    <div id="dialog-recuperatePwd">
        <p>Please enter your email address here:</p>
        <input type="text" name="email" value="" />
    </div>

</body>

</html>
