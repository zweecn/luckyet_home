<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>郑伟的主页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Description" content="西元前笔记">
<meta name="Keywords" content="西元前笔记">

<style type="text/css">
.sitestyle {	
	font-family: "华文行楷";
	font-size: xx-large;
}
.namestyle {	
	font-family: Georgia, Times New Roman, Times, serif;
}
body,td,th {
	font-family: Georgia, Times New Roman, Times, serif;
}
a:link {
	color: #006699;
	text-decoration: none;
}
a:visited {
	color: #3399CC;
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
	color: #006699;
}
.article{
	clear: both;
	padding: 5px 0px 0px 10px;
	font-size: 80%;
}
#art {
	float:left;
	position : absolute;
	margin-right:240px;
	clear:both;
	padding: 10px 0px 0px 10px;
}
#weibo {
	float:right;
	padding: 0px;
	background-color: #eeeeee;
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	width: 230px;
	margin-right:10px;
}
#weibo_bar{
	width: 230px; 
	height: 460px; 
	padding: 0px;
}
#sitetitle{
	margin: 0;
	padding: 10px 0px;
	border-bottom: 1px solid #cccccc;
	width: 100%;
}
</style>
</head>

<body> 
<div id="sitetitle">
  <h1 class="sitestyle">幸运依旧</h1>
</div>

  <table border="0">
    <tr>
      <td height="0"><img src="http://luckyet.com/images/jay-150-150.jpg" width="150" ></td>
      <td valign="top" class="namestyle"><p>Hey, 我是<strong>郑伟</strong>(Vincent Zheng). 不要再看这张照片了，那不是我，他是我喜欢的歌手Jay :)</p>
          <table border="0">
            <tr>
              <td><div align="right">Email：</div></td>
              <td>  
			    <script language="JavaScript" type="text/JavaScript">
				  name="zwee.cn";
				  domain="gmail.com";
				  email=name+"@"+domain;
                  document.writeln("<a href=\"mailto:"+email+"\">"+email+"</a>");
                </script>  
              </td>
            </tr>
			<tr>
              <td><div align="right">推特：</div></td>
              <td><a href="http://goo.gl/eK8j6" target="_blank">@zweecn</a></td>
            </tr>
			<tr>
              <td><div align="right">新浪微博：</div></td>
              <td><a href="http://weibo.com/zween" target="_blank">@郑伟-Vincent</a></td>
            </tr>
			<tr>
              <td><div align="right">腾讯微博：</div></td>
              <td><a href="http://t.qq.com/zwee_cn" target="_blank">@郑伟</a></td>
            </tr>
			<tr>
              <td><div align="right">我的博客：</div></td>
              <td><a href="http://blog.luckyet.com" target="_blank">西元前笔记</a></td>
              <td><a href="http://blog.luckyet.com/feed" target="_blank"><img src="images/rss.gif" alt="RSS" border="0"></a></td>
            </tr>

      </table></td>
    </tr>
  </table>
<hr>
<div id="weibo">
<iframe width="100%" height="460" class="share_self"  frameborder="0" scrolling="no" src="http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=460&fansRow=1&ptype=1&speed=0&skin=1&isTitle=1&noborder=1&isWeibo=1&isFans=0&uid=2256094682&verifier=cc31d438&dpc=1"></iframe>
<iframe frameborder="0" scrolling="no" src="http://show.v.t.qq.com/index.php?c=show&a=index&n=zwee_cn&w=0&h=460&fl=2&l=30&o=29&co=1" width="100%" height="460"></iframe>
</div>

<?php
//RSS源地址列表数组
$rssfeed = array("http://blog.luckyet.com/feed");
//截取utf8字符串 
function utf8Substr($str, $from, $len) 
{ 
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. 
                        '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', 
                        '$1',$str); 
}

echo "<div id='art'>";
for($i=0;$i<count($rssfeed);$i++){//分解开始
    $buff = "";
    $rss_str="";
    //打开rss地址，并读取，读取失败则中止
    $fp = fopen($rssfeed[$i],"r") or die("can not open $rssfeed"); 
    while ( !feof($fp) ) {
        $buff .= fgets($fp,4096);
    }
    //关闭文件打开
    fclose($fp);
        
    //建立一个 XML 解析器
    $parser = xml_parser_create();
    //xml_parser_set_option -- 为指定 XML 解析进行选项设置
    xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
    //xml_parse_into_struct -- 将 XML 数据解析到数组$values中
    xml_parse_into_struct($parser,$buff,$values,$idx);
    //xml_parser_free -- 释放指定的 XML 解析器
    xml_parser_free($parser);

    foreach ($values as $val) {
        $tag = $val["tag"];
        $type = $val["type"];
        $value = $val["value"];
        //标签统一转为小写
        $tag = strtolower($tag);
       
        //增加文章内容和日期
        if ($tag == "description") {
        	//$desc = $value; 
           	$desc = utf8Substr($value, 0, 50); 
        }
        if ($tag == "pubdate") {
           $date = $value; 
        }

        if ($tag == "item" && $type == "open"){
            $is_item = 1;
        }else if ($tag == "item" && $type == "close") {
            //构造输出字符串
            $rss_str .= "<div class='article'><h3><a href='".$link."' target=_blank>".$title."</a> (".$date.")</h3><blockquote>".$desc." <a href='".$link."' target=_blank>Read more <span class='meta-nav'>&#187;</span></a></blockquote></div>";
            $is_item = 0;
        }
        //仅读取item标签中的内容
        if($is_item==1){
            if ($tag == "title") {$title = $value;}        
            if ($tag == "link") {$link = $value;}
        }
    }
    //输出结果
    echo $rss_str."<br />";
}
echo "</div>"; 
?>

<!--clicki-->
<div id="clicki_widget_5540" ></div>
<script type='text/javascript'>
(function() {
    var c = document.createElement('script'); 
    c.type = 'text/javascript';
    c.async = true;
    c.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'www.clicki.cn/boot/48689';
    var h = document.getElementsByTagName('script')[0];
    h.parentNode.insertBefore(c, h);
})();
</script>

<!--Google-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31463860-1']);
  _gaq.push(['_setDomainName', 'luckyet.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</body>
</html>
