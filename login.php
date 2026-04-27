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
        .modern-login-box {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            padding: 2rem 1.5rem;
            margin: 0 auto;
            font-family: 'DM Sans', system-ui, -apple-system, sans-serif;
            border: 1px solid #f0f0f0;
        }
        .modern-login-title {
            margin: 0 0 1.5rem 0;
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .form-group label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.4rem;
        }
        .modern-login-form input[type="text"],
        .modern-login-form input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
            background: #f8fafc;
        }
        .modern-login-form input[type="text"]:focus,
        .modern-login-form input[type="password"]:focus {
            border-color: #52b788;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
        }
        .form-actions {
            margin-top: 1.5rem;
            text-align: center;
        }
        .modern-btn {
            background-color: #2d6a4f;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        .modern-btn:hover {
            background-color: #1b4332;
        }
        .modern-btn:active {
            transform: translateY(1px);
        }
        #logonMsg {
            margin-bottom: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }
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
