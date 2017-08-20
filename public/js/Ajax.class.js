/**
 * Created by Administrator on 2017/4/26.
 *
  var ajax = new Ajax();
  ajax.post({
       async: true,
       url: 'http://www.skyisco.com/test3.php',
       data: {
           id: '950919',
           name: '于成龙'
       },
       success: function (response) {
           alert(response);
       }
  });

 ajax.htmlPost({
    url: 'http://www.skyisco.com/test3.php',
    data: {
       id: '950919',
       name: '于成龙'
    }
 });

 */
function Ajax() {
    //公共方法
    this.get = function (opt) {
        send('GET', opt);
    };
    this.post = function (opt) {
        send('POST', opt);
    };


    //模拟get提交
    this.htmlGet = function (opt) {
        htmlSend('GET',opt);
    }


    //模拟post提交
    this.htmlPost = function (opt) {
        htmlSend('POST',opt);
    }

    //私有方法
    function send(method, opt) {
        var noCache = '?t=' + new Date().getTime();

        xmlHttp = XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        var params = [];
        for (var key in opt.data)
            params.push(key + '=' + opt.data[key]);

        postData = params.join('&');

        if (method === 'GET') {
            xmlHttp.open(method, opt.url + noCache + '&' + postData, opt.async);
            xmlHttp.send(null);
        } else {
            xmlHttp.open(method, opt.url + noCache, opt.async);
            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
            xmlHttp.send(postData);
        }

        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                opt.success(xmlHttp.responseText);
            }
        };
    }

    //私有方法
    function htmlSend(method,opt) {
        var data = opt.data || {};
        var temp = document.createElement("form");
        temp.action = opt.url;
        temp.method = method;
        temp.style.display = "none";
        for (var x in data) {
            var input = document.createElement("input");
            input.name = x;
            input.value = opt.data[x];
            temp.appendChild(input);
        }
        document.body.appendChild(temp);
        temp.submit();
        temp.parentNode.removeChild(temp);
    }
}