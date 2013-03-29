<?php

 require 'connect.inc.php';




//check db notifications table for records with notifications_type = 'New_message' and Sent = '0' 
//each row will need to have an email sent with the appropriate stings inserted
// create while loop for entire php code of php mailer (with variables inserted from db)
 //after sending email change notification record to sent ...so it wont be sent again. 
 //need: First_name_sendor, First_name_reciepent, Message_preview


$query = "SELECT n.Sent, n.Notification_id as ID, p1.Name as Match1_name, p1.Email as Match1_email, s1.New_active_match_email as Match1_allow, p2.Name as Match2_name, p2.Email as Match2_email, s2.New_active_match_email as Match2_allow\n"
    . "FROM notifications as n\n"
    . "JOIN profiles as p1\n"
    . "ON n.Actor1_id = p1.userid\n"
    . "JOIN profiles as p2\n"
    . "ON n.Actor2_id = p2.userid\n"
    . "JOIN settings as s1\n"
    . "ON n.Actor1_id = s1.Userid\n"  
    . "JOIN settings as s2\n"
    . "ON n.Actor2_id = s2.Userid\n"   
    . "WHERE `Notification_type` = 'Active_match'\n"
    . "AND `Sent` = 0";

    

    //run query in order to save all notifications id. THis is needed to update those notifications to sent, so they wont be sent again. 
      $loop = mysql_query($query);

    // check if any rows were returned if so, continue, else do nothing. 
      if (mysql_num_rows($loop)) { 

    //create empyt array called rows
      $rows = array();

    //put returned rows from the query into rows array. 
        while($row = mysql_fetch_assoc($loop)){ 
            $rows[] = $row;
        }

        //create empty array to store notifications to update (before sending any email to prevent pontential spamming of users.)
        $updateToSent = array();

        //for each row put id into another array updateToSent.
        foreach($rows as $row) {
            //add notifciation ID to array updateToSent. 
            array_push($updateToSent, $row['ID']);
          
        }

        // format array so that SQL can handle it
        $ids = join(',',$updateToSent); 

        // // update each notification wihtin updateToSent to sent in the db.
        $sql = "UPDATE `notifications` SET `Sent`=1 WHERE `Notification_id` IN ($ids)"; 

        //run query
        mysql_query($sql)or die (mysql_error());

        //end script if no results are found. 

        //print_r($ids);

        //require 'class.phpmailer.php';

        $allowToSend1 = $rows['0']['Match1_allow'];
        $allowToSend2 = $rows['0']['Match2_allow'];
        
        // construct foreach loop to send html formated email to each recipient. 
        foreach($rows as $row)
        {

        //send first email to user1 of the match
        $mail = new PHPMailer;
        $mail->IsSMTP();  
        $mail->SMTPDebug = 1; // 1 tells it to display SMTP errors and messages, 0 turns off all errors and messages, 2 prints messages only.
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        $mail->Host = "relay-hosting.secureserver.net";
        $mail->Port = 25;

        $mail->Username = "theteam@throughourfriends.com";
        $mail->Password = "December101985";
        $mail->IsHTML(true);
        $mail->From = "theteam@throughourfriends.com";
        $mail->FromName = "ThroughOurFriends";
        $mail->AddAddress($row['Match1_email'], $row['Match1_name']);

        //$mail->AddReplyTo("Email Address HERE", "Name HERE"); // Adds a "Reply-to" address. Un-comment this to use it.
        $mail->Subject = "You've got a new match!";
        $mail->Body = ('
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
        @media only screen and (max-device-width: 480px) { 
        table[class=w0], td[class=w0] { width: 0 !important; }
        table[class=w10], td[class=w10], img[class=w10] { width:10px !important; }
        table[class=w15], td[class=w15], img[class=w15] { width:5px !important; }
        table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
        table[class=w60], td[class=w60], img[class=w60] { width:10px !important; }
        table[class=w125], td[class=w125], img[class=w125] { width:80px !important; }
        table[class=w130], td[class=w130], img[class=w130] { width:55px !important; }
        table[class=w140], td[class=w140], img[class=w140] { width:90px !important; }
        table[class=w160], td[class=w160], img[class=w160] { width:180px !important; }
        table[class=w170], td[class=w170], img[class=w170] { width:100px !important; }
        table[class=w180], td[class=w180], img[class=w180] { width:80px !important; }
        table[class=w195], td[class=w195], img[class=w195] { width:80px !important; }
        table[class=w220], td[class=w220], img[class=w220] { width:80px !important; }
        table[class=w240], td[class=w240], img[class=w240] { width:180px !important; }
        table[class=w255], td[class=w255], img[class=w255] { width:185px !important; }
        table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
        table[class=w280], td[class=w280], img[class=w280] { width:135px !important; }
        table[class=w300], td[class=w300], img[class=w300] { width:140px !important; }
        table[class=w325], td[class=w325], img[class=w325] { width:95px !important; }
        table[class=w360], td[class=w360], img[class=w360] { width:140px !important; }
        table[class=w410], td[class=w410], img[class=w410] { width:180px !important; }
        table[class=w470], td[class=w470], img[class=w470] { width:200px !important; }
        table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
        table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
        table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }
        table[class=h0], td[class=h0] { height: 0 !important; }
        p[class=footer-content-left] { text-align: center !important; }
        #headline p { font-size: 30px !important; }
        .article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }
        .header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}
        img { height: auto; line-height: 100%;}
         } 
        #outlook a { padding: 0; }  
        body { width: 100% !important; }
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; display:block !important; } 
        body { background-color: #ececec; margin: 0; padding: 0; }
        img { outline: none; text-decoration: none; display: block;}
        br, strong br, b br, em br, i br { line-height:100%; }
        h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
        h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active { color: red !important; }
        h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
          
        table td, table tr { border-collapse: collapse; }
        .yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
        color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
        } 
        code {
          white-space: normal;
          word-break: break-all;
        }
        #background-table { background-color: #ececec; }
        #top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #043948; color: #e7cba3; }
        #top-bar a { font-weight: bold; color: #e7cba3; text-decoration: none;}
        #footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }
        body, td { font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
        .header-content { font-size: 12px; color: #e7cba3; }
        .header-content a { font-weight: bold; color: #e7cba3; text-decoration: none; }
        #headline p { color: #e7cba3; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }
        #headline p a { color: #e7cba3; text-decoration: none; }
        .article-title { font-size: 18px; line-height:24px; color: #9a9661; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .article-title a { color: #9a9661; text-decoration: none; }
        .article-title.with-meta {margin-bottom: 0;}
        .article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}
        .article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .article-content a { color: #00707b; font-weight:bold; text-decoration:none; }
        .article-content img { max-width: 100% }
        .article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }
        .article-content li { font-size: 13px; line-height: 18px; color: #444444; }
        .article-content li a { color: #00707b; text-decoration:underline; }
        .article-content p {margin-bottom: 15px;}
        .footer-content-left { font-size: 12px; line-height: 15px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
        .footer-content-left a { color: #e7cba3; font-weight: bold; text-decoration: none; }
        .footer-content-right { font-size: 11px; line-height: 16px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
        .footer-content-right a { color: #e7cba3; font-weight: bold; text-decoration: none; }
        #footer { background-color: #043948; color: #e2e2e2; }
        #footer a { color: #e7cba3; text-decoration: none; font-weight: bold; }
        #permission-reminder { white-space: normal; }
        #street-address { color: #e7cba3; white-space: normal; }
        </style>
        <!--[if gte mso 9]>
        <style _tmplitem="423" >
        .article-content ol, .article-content ul {
           margin: 0 0 0 24px !important;
           padding: 0 !important;
           list-style-position: inside !important;
        }
        </style>
        <![endif]--><meta name="robots" content="noindex,nofollow"></meta>
        <meta property="og:title" content="Friend name has created your profile with Throughourfriends"></meta>
        </head><body style="width:100% !important;background-color:#ececec;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" ><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#ececec;" >
          <tbody><tr style="border-collapse:collapse;" >
            <td align="center" bgcolor="#ececec" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                  <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;" >
                      <tbody><tr style="border-collapse:collapse;" ><td class="w640" width="640" height="20" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        
                      <tr style="border-collapse:collapse;" >
                          <td class="w640" width="640" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                                <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#00707b" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#043948;color:#e7cba3;" >
            <tbody><tr style="border-collapse:collapse;" >
                <td class="w15" width="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                <td class="w325" width="350" valign="middle" align="left" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w325" width="350" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                    <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#e7cba3;" ><a href="http://preview.createsend1.com/t/t-e-qjllkl-l-r/" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Web Version</a><span class="hide">&nbsp;&nbsp;|&nbsp; <a href="http://client.updatemyprofile.com/t-l-2AD73FFF-l-y" lang="en" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Update preferences</a>&nbsp;&nbsp;|&nbsp; <a href="http://preview.createsend1.com/t/t-u-qjllkl-l-j/" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Unsubscribe</a></span></div>
                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w325" width="350" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
                <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                <td class="w255" width="255" valign="middle" align="right" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w255" width="255" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                    <table cellpadding="0" cellspacing="0" border="0">
            <tbody><tr style="border-collapse:collapse;" >
                
                
                
            </tr>
        </tbody></table>
                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w255" width="255" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
                <td class="w15" width="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
            </tr>
        </tbody></table>
                                
                            </td>
                        </tr>
                        <tr style="border-collapse:collapse;" >
                        <td id="header" class="w640" width="640" align="center" bgcolor="#00707b" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            
            <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580" width="580" height="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                <tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                        <div align="center" id="headline">
                            <p style="color:#e7cba3;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;" >
                                <strong><a href="http://throughourfriendscom.createsend1.com/t/t-l-qjllkl-l-d/" style="color:#e7cba3;text-decoration:none;" >You have a new message</a></strong>
                            </p>
                        </div>
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
            </tbody></table>
            
            
        </td>
                        </tr>
                        
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        <tr id="simple-content-row" style="border-collapse:collapse;" ><td class="w640" width="640" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                        
                                <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr style="border-collapse:collapse;" >
                                        <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                                            <p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#9a9661;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" >Congrats '. $row['Match1_name'].'! You have a new pending match.</p>
                                            <div align="left" class="article-content" style="font-size:13px;line-height:18px;color:#444444;margin-top:0px;margin-bottom:18px;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" >
                                                <p style="margin-bottom:15px;" >
          '.$row["Match2_name"].' is now one of your active matches! <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          All active matches have already been accepted by you, them, and atleast one of your friends or theirs. <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          Click here to login to your account and check them out! <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          - The team at Throughourfriends</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="border-collapse:collapse;" ><td class="w580" width="580" height="10" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                                </tbody></table>
                            
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
            </tbody></table>
        </td></tr>
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        
                        <tr style="border-collapse:collapse;" >
                        <td class="w640" width="640" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#043948" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#043948;color:#e2e2e2;" >
                <tbody><tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580 h0" width="360" height="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="160" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                <tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="360" valign="top" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#e2e2e2;margin-top:0px;margin-bottom:15px;white-space:normal;" ></p></span>
                    <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#e2e2e2;margin-top:0px;margin-bottom:15px;" ><a href="http://client.updatemyprofile.com/t-l-2AD73FFF-l-t" lang="en" style="color:#e7cba3;text-decoration:none;font-weight:bold;" >Edit your subscription</a> | <a href="http://preview.createsend1.com/t/t-u-qjllkl-l-i/" style="color:#e7cba3;text-decoration:none;font-weight:bold;" >Unsubscribe</a></p>
                    </td>
                    <td class="hide w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="hide w0" width="160" valign="top" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <p id="street-address" align="right" class="footer-content-right" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:11px;line-height:16px;margin-top:0px;margin-bottom:15px;color:#e7cba3;white-space:normal;" ></p>
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
                <tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580 h0" width="360" height="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="160" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
            </tbody></table>
        </td>
                        </tr>
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
          </tr>
        </tbody></table></body></html>
        ');

        if ($allowToSend1 == 1) {
            if ($mail->Send() == true) {
            //echo "The message has been sent";
            }
            else {
            //echo "The email message has NOT been sent for some reason. Please try again later.";
            //echo "Mailer error: " . $mail->ErrorInfo;
            }
        }


        //send second email to user2 of the match

        $mail = new PHPMailer;
        $mail->IsSMTP();  
        $mail->SMTPDebug = 1; // 1 tells it to display SMTP errors and messages, 0 turns off all errors and messages, 2 prints messages only.
        //$mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";
        $mail->Host = "relay-hosting.secureserver.net";
        $mail->Port = 25;

        $mail->Username = "theteam@throughourfriends.com";
        $mail->Password = "December101985";
        $mail->IsHTML(true);
        $mail->From = "theteam@throughourfriends.com";
        $mail->FromName = "ThroughOurFriends";
        $mail->AddAddress($row['Match2_email'], $row['Match2_name']);

        //$mail->AddReplyTo("Email Address HERE", "Name HERE"); // Adds a "Reply-to" address. Un-comment this to use it.
        $mail->Subject = "You've got a new match!";
        $mail->Body = ('
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
        @media only screen and (max-device-width: 480px) { 
        table[class=w0], td[class=w0] { width: 0 !important; }
        table[class=w10], td[class=w10], img[class=w10] { width:10px !important; }
        table[class=w15], td[class=w15], img[class=w15] { width:5px !important; }
        table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
        table[class=w60], td[class=w60], img[class=w60] { width:10px !important; }
        table[class=w125], td[class=w125], img[class=w125] { width:80px !important; }
        table[class=w130], td[class=w130], img[class=w130] { width:55px !important; }
        table[class=w140], td[class=w140], img[class=w140] { width:90px !important; }
        table[class=w160], td[class=w160], img[class=w160] { width:180px !important; }
        table[class=w170], td[class=w170], img[class=w170] { width:100px !important; }
        table[class=w180], td[class=w180], img[class=w180] { width:80px !important; }
        table[class=w195], td[class=w195], img[class=w195] { width:80px !important; }
        table[class=w220], td[class=w220], img[class=w220] { width:80px !important; }
        table[class=w240], td[class=w240], img[class=w240] { width:180px !important; }
        table[class=w255], td[class=w255], img[class=w255] { width:185px !important; }
        table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
        table[class=w280], td[class=w280], img[class=w280] { width:135px !important; }
        table[class=w300], td[class=w300], img[class=w300] { width:140px !important; }
        table[class=w325], td[class=w325], img[class=w325] { width:95px !important; }
        table[class=w360], td[class=w360], img[class=w360] { width:140px !important; }
        table[class=w410], td[class=w410], img[class=w410] { width:180px !important; }
        table[class=w470], td[class=w470], img[class=w470] { width:200px !important; }
        table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
        table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
        table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }
        table[class=h0], td[class=h0] { height: 0 !important; }
        p[class=footer-content-left] { text-align: center !important; }
        #headline p { font-size: 30px !important; }
        .article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }
        .header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}
        img { height: auto; line-height: 100%;}
         } 
        #outlook a { padding: 0; }  
        body { width: 100% !important; }
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; display:block !important; } 
        body { background-color: #ececec; margin: 0; padding: 0; }
        img { outline: none; text-decoration: none; display: block;}
        br, strong br, b br, em br, i br { line-height:100%; }
        h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
        h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
        h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active { color: red !important; }
        h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
          
        table td, table tr { border-collapse: collapse; }
        .yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
        color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
        } 
        code {
          white-space: normal;
          word-break: break-all;
        }
        #background-table { background-color: #ececec; }
        #top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #043948; color: #e7cba3; }
        #top-bar a { font-weight: bold; color: #e7cba3; text-decoration: none;}
        #footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }
        body, td { font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
        .header-content { font-size: 12px; color: #e7cba3; }
        .header-content a { font-weight: bold; color: #e7cba3; text-decoration: none; }
        #headline p { color: #e7cba3; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }
        #headline p a { color: #e7cba3; text-decoration: none; }
        .article-title { font-size: 18px; line-height:24px; color: #9a9661; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .article-title a { color: #9a9661; text-decoration: none; }
        .article-title.with-meta {margin-bottom: 0;}
        .article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}
        .article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
        .article-content a { color: #00707b; font-weight:bold; text-decoration:none; }
        .article-content img { max-width: 100% }
        .article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }
        .article-content li { font-size: 13px; line-height: 18px; color: #444444; }
        .article-content li a { color: #00707b; text-decoration:underline; }
        .article-content p {margin-bottom: 15px;}
        .footer-content-left { font-size: 12px; line-height: 15px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
        .footer-content-left a { color: #e7cba3; font-weight: bold; text-decoration: none; }
        .footer-content-right { font-size: 11px; line-height: 16px; color: #e2e2e2; margin-top: 0px; margin-bottom: 15px; }
        .footer-content-right a { color: #e7cba3; font-weight: bold; text-decoration: none; }
        #footer { background-color: #043948; color: #e2e2e2; }
        #footer a { color: #e7cba3; text-decoration: none; font-weight: bold; }
        #permission-reminder { white-space: normal; }
        #street-address { color: #e7cba3; white-space: normal; }
        </style>
        <!--[if gte mso 9]>
        <style _tmplitem="423" >
        .article-content ol, .article-content ul {
           margin: 0 0 0 24px !important;
           padding: 0 !important;
           list-style-position: inside !important;
        }
        </style>
        <![endif]--><meta name="robots" content="noindex,nofollow"></meta>
        <meta property="og:title" content="Friend name has created your profile with Throughourfriends"></meta>
        </head><body style="width:100% !important;background-color:#ececec;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" ><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#ececec;" >
          <tbody><tr style="border-collapse:collapse;" >
            <td align="center" bgcolor="#ececec" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                  <table class="w640"  width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;" >
                      <tbody><tr style="border-collapse:collapse;" ><td class="w640" width="640" height="20" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        
                      <tr style="border-collapse:collapse;" >
                          <td class="w640" width="640" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                                <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#00707b" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#043948;color:#e7cba3;" >
            <tbody><tr style="border-collapse:collapse;" >
                <td class="w15" width="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                <td class="w325" width="350" valign="middle" align="left" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w325" width="350" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                    <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#e7cba3;" ><a href="http://preview.createsend1.com/t/t-e-qjllkl-l-r/" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Web Version</a><span class="hide">&nbsp;&nbsp;|&nbsp; <a href="http://client.updatemyprofile.com/t-l-2AD73FFF-l-y" lang="en" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Update preferences</a>&nbsp;&nbsp;|&nbsp; <a href="http://preview.createsend1.com/t/t-u-qjllkl-l-j/" style="font-weight:bold;color:#e7cba3;text-decoration:none;" >Unsubscribe</a></span></div>
                    <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w325" width="350" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
                <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                <td class="w255" width="255" valign="middle" align="right" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w255" width="255" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                    <table cellpadding="0" cellspacing="0" border="0">
            <tbody><tr style="border-collapse:collapse;" >
                
                
                
            </tr>
        </tbody></table>
                    <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                        <tbody><tr style="border-collapse:collapse;" ><td class="w255" width="255" height="8" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
                <td class="w15" width="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
            </tr>
        </tbody></table>
                                
                            </td>
                        </tr>
                        <tr style="border-collapse:collapse;" >
                        <td id="header" class="w640" width="640" align="center" bgcolor="#00707b" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            
            <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580" width="580" height="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                <tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                        <div align="center" id="headline">
                            <p style="color:#e7cba3;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;" >
                                <strong><a href="http://throughourfriendscom.createsend1.com/t/t-l-qjllkl-l-d/" style="color:#e7cba3;text-decoration:none;" >You have a new message</a></strong>
                            </p>
                        </div>
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
            </tbody></table>
            
            
        </td>
                        </tr>
                        
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        <tr id="simple-content-row" style="border-collapse:collapse;" ><td class="w640" width="640" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            <table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                <tbody><tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                        
                                <table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                                    <tbody><tr style="border-collapse:collapse;" >
                                        <td class="w580" width="580" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                                            <p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#9a9661;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" >Congrats '. $row['Match2_name'].'! You have a new pending match.</p>
                                            <div align="left" class="article-content" style="font-size:13px;line-height:18px;color:#444444;margin-top:0px;margin-bottom:18px;font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;" >
                                                <p style="margin-bottom:15px;" >
          '.$row["Match1_name"].' is now one of your active matches! <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          All active matches have already been accepted by you, them, and atleast one of your friends or theirs. <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          Click here to login to your account and check them out! <br style="line-height:100%;" />
          <br style="line-height:100%;" />
          - The team at Throughourfriends</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="border-collapse:collapse;" ><td class="w580" width="580" height="10" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                                </tbody></table>
                            
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
            </tbody></table>
        </td></tr>
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                        
                        <tr style="border-collapse:collapse;" >
                        <td class="w640" width="640" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
            <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#043948" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#043948;color:#e2e2e2;" >
                <tbody><tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580 h0" width="360" height="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="160" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                <tr style="border-collapse:collapse;" >
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="w580" width="360" valign="top" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <span class="hide"><p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#e2e2e2;margin-top:0px;margin-bottom:15px;white-space:normal;" ></p></span>
                    <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#e2e2e2;margin-top:0px;margin-bottom:15px;" ><a href="http://client.updatemyprofile.com/t-l-2AD73FFF-l-t" lang="en" style="color:#e7cba3;text-decoration:none;font-weight:bold;" >Edit your subscription</a> | <a href="http://preview.createsend1.com/t/t-u-qjllkl-l-i/" style="color:#e7cba3;text-decoration:none;font-weight:bold;" >Unsubscribe</a></p>
                    </td>
                    <td class="hide w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                    <td class="hide w0" width="160" valign="top" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" >
                    <p id="street-address" align="right" class="footer-content-right" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:11px;line-height:16px;margin-top:0px;margin-bottom:15px;color:#e7cba3;white-space:normal;" ></p>
                    </td>
                    <td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td>
                </tr>
                <tr style="border-collapse:collapse;" ><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w580 h0" width="360" height="15" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w0" width="160" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td><td class="w30" width="30" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
            </tbody></table>
        </td>
                        </tr>
                        <tr style="border-collapse:collapse;" ><td class="w640" width="640" height="60" style="font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif;border-collapse:collapse;" ></td></tr>
                    </tbody></table>
                </td>
          </tr>
        </tbody></table></body></html>
        ');

        if ($allowToSend2 == 1) {
            if ($mail->Send() == true) {
            //echo "The message has been sent";
            }
            else {
            //echo "The email message has NOT been sent for some reason. Please try again later.";
            //echo "Mailer error: " . $mail->ErrorInfo;
            }
        }
    }

    }else{
    //no notifications to send
}



?>
