<div style = "background-color: rgba(70, 73, 85, 1);height:100%;width:150px;position: fixed;font-size:14px;">
    <div id = "leftDiv1" style= "padding-top:50px;width:100%;height:60px;">
        <span id = "span1" class = "left-div-span"></span>
        <img class = "img" src = "{{ asset('img/index.png') }}">
        <a href="javaScript:void(0)" onclick = "goIndex()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">首页</a>
    </div>
    <div id = "leftDiv2" style = "width:100%;height:60px">
        <span id = "span2" class = "left-div-span"> </span>
        <img class = "img"  src = "{{ asset('img/management.png') }}">
        <a href="javaScript:void(0)" onclick = "goAccount()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">账户管理</a>
    </div>
    <div id = "leftDiv3" style = "width:100%;height:60px;">
        <span id = "span3" class = "left-div-span"> </span>
        <img class = "img"  src = "{{ asset('img/creditor.png') }}">
        <a href="javaScript:void(0)" onclick = "goZhaiQuan()" target="_top" style = "color:#fff;text-decoration: none;position: relative;left: 25px;top:6px;">债权管理</a>
    </div>
</div>