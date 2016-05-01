<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>laravel-wechat-demo</title>
</head>
<body>
    <br/>
    <p>laravel-wechat-demo</p>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">0.01元</span>钱</b></font><br/><br/>
	<div align="center">
		<button id="pay" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" >立即支付</button>
	</div>
    <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">

    $(document).ready(function() {

        function jsApiCall() {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
                {!! $jsApiParams !!},
                function(res){
                    WeixinJSBridge.log(res.err_msg);
                    if (res.err_msg == "get_brand_wcpay_request:ok" ) {
                        alert('pay succ');
                    } else {
                        alert("code:"+res.err_code+" "+"descript : "+res.err_desc+" error_msg : "+res.err_msg);
                    }
                }
            );
        };

        function callpay() {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        };

        $('#pay').bind('click', function() {
            callpay();
        });

    });

    </script>
</body>
</html>
