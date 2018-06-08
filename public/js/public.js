    var div = '    <div style = "z-index:999;width:100%;height:100%">'
    +'<div style = "background-color: rgba(70, 73, 85, 1);height:50px;width:100%;position: fixed;z-index:999;">'
    +' <span style = "color:#fff;padding:5px;position: fixed;">小鸡惠普</span>'
    +' <div style = "float:right;color:#fff;padding-right:50px;">'
    +'        <span>欢迎sssss用户</span>'
    +'        <img class = "img" onclick="logout()" style = "top:9px;left:0px;" src = "img/cancellation.png">'
    +'        <span onclick="logout()">注销</span>'
    +'    </div>'
    +'</div>'
    +'<div style = "background-color: rgba(70, 73, 85, 1);height:100%;width:150px;position: fixed;font-size:14px;">'
    +'   <div id = "leftDiv1" style= "padding-top:50px;width:100%;height:60px;">'
    +'       <span id = "span1" class = "spanLeft"></span>'
    +'       <img class = "img" src = "img/index.png">'
    +'        <a href="javaScript:void(0)" onclick = "goIndex()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">首页</a>'
    +'   </div>'
    +'    <div id = "leftDiv2" style = "width:100%;height:60px">'
    +'         <span id = "span2" class = "spanLeft2"> </span>'
    +'        <img class = "img" src = "img/management.png">'
    +'       <a href="javaScript:void(0)" onclick = "goAccount()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">账户管理</a>'
    +'    </div>'
    +'    <div id = "leftDiv3" style = "width:100%;height:60px;">'
    +'        <span id = "span3" class = "spanLeft3"> </span>'
    +'        <img class = "img" src = "img/creditor.png">'
    +'        <a href="javaScript:void(0)" onclick = "goZhaiQuan()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">债权管理</a>'
    +'    </div>'
    +' </div>'
    +'</div>';
    $(".bodys").prepend(div);  
    function logout(){
        //跳出父框架
        window.parent.frames.location.href="login.html";
        // window.location.href="login.html"; 
    }
