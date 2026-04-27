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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
    <link rel="stylesheet" type="text/css" media="screen" href="css/login.css" />



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
                        <div class="form-group">
                            <label><?= $Text['lang']; ?></label>
                            <div class="language-picker">
                                <div class="lang-option <?= (get_session_language() == 'ca-va' ? 'active' : '') ?>" data-value="ca-va" title="Català">
                                    <span class="flag-icon">🌻</span>
                                    <span class="lang-label">Català</span>
                                </div>
                                <div class="lang-option <?= (get_session_language() == 'es' ? 'active' : '') ?>" data-value="es" title="Español">
                                    <span class="flag-icon">
                                        <svg width="20" height="14" viewBox="0 0 750 500"><rect width="750" height="500" fill="#c60b1e"/><rect width="750" height="250" y="125" fill="#ffc400"/></svg>
                                    </span>
                                    <span class="lang-label">Español</span>
                                </div>
                                <div class="lang-option <?= (get_session_language() == 'en' ? 'active' : '') ?>" data-value="en" title="English">
                                    <span class="flag-icon">
                                        <svg width="20" height="14" viewBox="0 0 60 30"><clipPath id="s"><path d="M0,0 v30 h60 v-30 z"/></clipPath><path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6" clip-path="url(#s)"/><path d="M0,0 L60,30 M60,0 L0,30" stroke="#012169" stroke-width="4" clip-path="url(#s)"/><path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/><path d="M30,0 v30 M0,15 h60" stroke="#c8102e" stroke-width="6"/></svg>
                                    </span>
                                    <span class="lang-label">English</span>
                                </div>
                            </div>
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

    <script type="text/javascript">
        $(function() {
            $('.lang-option').click(function() {
                var new_lang = $(this).data('value');
                $.ajax({
                    type: "POST",
                    url: "php/ctrl/AixadaSession.php",
                    data: {
                        change_lang_to: new_lang,
                        originating_uri: 'login.php'
                    },
                    dataType: "xml",
                    success: function(xml) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
</body>

</html>
