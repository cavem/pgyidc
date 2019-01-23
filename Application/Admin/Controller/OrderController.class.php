<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 蒲公英
 * 作者：小菜
 * 创建时间：2017-11-03 10:46:00
 */
class OrderController extends BaseController {
    public function alipayAction()
    {
        parent::nosession();
        $userid=session('loginuser.userid');
        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = 'pgy'.date('YmdHis',time()).'_'.$userid;
        //订单名称，必填
        $proName = "蒲公英网站充值";
        //付款金额，必填
        $total_amount = trim(I('money'));
        //商品描述，可空
        $body = '';//trim($_POST['WIDbody']);
        Vendor('Alipay.aop.AopClient');
        Vendor('Alipay.aop.request.AlipayTradePagePayRequest');

        $config = C('alipay');

        $c = new \AopClient();
        $c->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $c->appId = $config['app_id'];
        $c->rsaPrivateKey = $config['rsaprivateKey'];
        $c->format = "json";
        $c->charset= "GBK";
        $c->signType= "RSA2";
        $c->alipayrsaPublicKey = $config['alipayrsapublicKey'];

        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.open.public.template.message.industry.modify
        $request = new \AlipayTradePagePayRequest();
        $request->setReturnUrl($config['return_url']);
        $request->setNotifyUrl($config['notify_url']);

        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        //此次只是参数展示，未进行字符串转义，实际情况下请转义
        $request->setBizContent("{" .
            "    \"product_code\":\"FAST_INSTANT_TRADE_PAY\"," .
            "    \"subject\":\"$proName\"," .
            "    \"out_trade_no\":\"$out_trade_no\"," .
            "    \"total_amount\":$total_amount," .
            "    \"body\":\"$body\"" .
            "  }");
        $response = $c->pageExecute($request);
        echo $response;
    }
}