<head>
    <title>login</title>
</head>
<body>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Login.class.js"></script>
<script type="text/javascript" src="<?= $PUB_RES ?>/js/Ajax.class.js"></script>
<script type="text/javascript">
    new Login({
        logo: '/public/img/logo-login.gif',
        fn: function (userId, pssword) {
            new Ajax().post({
                async: true,
                url: 'login.act.php',
                data: {
                    act:'login',
                    uid: userId,
                    pwd: pssword
                },
                success: function (response) {
                    if(response == 'success'){
                        window.location.href = 'admin.html';
                    }else{
                        alert('用户名或者密码错误！');
                    }
                }
            });
        }
    });
</script>
</body>