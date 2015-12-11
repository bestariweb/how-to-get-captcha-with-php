<?php

    $cookie="cookie.txt";

    function open($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);  
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIE, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR,$cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE,$cookie);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
        curl_setopt ($ch, CURLOPT_REFERER, $url);
        $result = curl_exec($ch);  
        curl_close($ch);

        return $result;
    }

    function between($string, $start, $end)
    {
        $out = explode($start, $string);

        if(isset($out[1]))
        {
            $string = explode($end, $out[1]);
            echo $string[0];
            return $string[0];
        }

        return '';
    }

    function get_captcha()
    {
        $url    = 'https://academics.vit.ac.in/student/stud_login.asp';
        $open   = open($url);
        $code   = between($open, '<img src='https://academics.vit.ac.in/student/captcha.asp', '">');
        return 'https://academics.vit.ac.in/student/captcha.asp' . $code;

    }

    function rahul()
    {
        $capth=htmlspecialchars($_POST['code']);

        echo $capth;

        $username="xyz"; 
        $password="abc"; 
        $url=url of the form in which you want to submit your data; 
        $cookie="cookie.txt";
        $veri=$capth;

        $com="Login";

        $postdata = "regno=".$username."&passwd=".$password."&vrfcd=".$veri."&submit=".$com;

        $ch = curl_init(); 
        curl_setopt ($ch, CURLOPT_URL, $url); 
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); 
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie); 
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);  // <-- add this line
        curl_setopt ($ch, CURLOPT_REFERER, $url); 

        curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
        curl_setopt ($ch, CURLOPT_POST, 1); 
        $result = curl_exec ($ch); 

        echo $result;  

        $data = curl_exec($ch);
    }
?>

<html>
    <body>
        <form action="" method="post">
            <img src="<?php echo get_captcha(); ?>" border="0" /><br />
            <input type="text" name="code" value="<?= isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '' ?>" /><br />
            <input type="submit" name="submit" value="submit"/>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                rahul();
            }
        ?>
    </body>
</html>