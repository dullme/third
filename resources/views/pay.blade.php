<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>充值</title>
</head>
<body>
<div style="display: none">
    <form id="submit-form" method="post" action="{{ config('xiaoji.gatewayUrl') }}">
        @foreach( $data as $key=>$item)
            <input type="hidden" name="{{ $key }}" value="{{ $item }}">
        @endforeach
        <input type="submit" value="确定">
    </form>
</div>
<script>
    window.onload=function (){

        submit();

    }
    function submit(){
        // event.preventDefault();
        document.getElementById('submit-form').submit();
    }
</script>
</body>
</html>