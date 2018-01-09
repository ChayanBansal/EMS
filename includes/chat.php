<?php
require('config.php');
session_start();        
if(isset($_POST['msg']))
{
    if(isset($_SESSION['super_admin_username']))
    {
        $self_username=$_SESSION['super_admin_username'];
    }
    else
    {
        $self_username=$_SESSION['operator_username'];
    }
    
    $send_msg="INSERT INTO chat (sender, receiver, msg) VALUES('".$self_username."','".$_POST['username']."','".$_POST['msg']."')";
    $send_msg_run=mysqli_query($conn,$send_msg);
    if($send_msg_run==FALSE)
    {
        echo('<li class="list-group-item" style="font-size:1.5rem;background-color:red">The message was not sent</li>');
    }
}
else
{
    $username=$_POST['username'];
    if(isset($_SESSION['super_admin_username']))
    {
        $self_username=$_SESSION['super_admin_username'];
    }
    else
    {
        $self_username=$_SESSION['operator_username'];
    }
    $get_chat="SELECT chat_id, sender, msg, timestamp FROM chat WHERE (sender='".$self_username."' AND receiver='".$username."') OR (receiver='".$self_username."' AND sender='".$username."')";
    $get_chat_run=mysqli_query($conn,$get_chat);
    $get_last_record="SELECT chat_id FROM chat WHERE (sender='".$self_username."' AND receiver='".$username."') OR (receiver='".$self_username."' AND sender='".$username."') ORDER BY chat_id DESC LIMIT 1";
    $get_last_record_run=mysqli_query($conn,$get_last_record);
    
    try
    {
        $last_record=mysqli_fetch_assoc($get_last_record_run);
        while($chat=mysqli_fetch_assoc($get_chat_run))
        {
            if($chat['sender']!=$self_username)
            {
                if($last_record['chat_id']==$chat['chat_id'])
                {
                    echo('<li class="list-group-item" style="font-size:1.5rem;background-color:#FFBFB4">
                    '. $chat['timestamp'].':<br>'.$chat['msg']);
                    echo('</li>');
                }
                else
                {
                    echo('<li class="list-group-item" style="font-size:1.5rem;background-color:#FFF4F2">
                    '. $chat['timestamp'].':<br>'.$chat['msg']);
                    echo('</li>');
                }
                
            }
            else if($chat['sender']==$self_username)
            {
                if($last_record['chat_id']==$chat['chat_id'])
                {
                    echo('<li id="last_chat" class="list-group-item" style="font-size:1.5rem; text-align:right; background-color:#E8FAFF">
                    '. $chat['timestamp'].':<br>'.$chat['msg']);
                    echo('</li>');    
                }
                else
                {
                    
                echo('<li class="list-group-item" style="font-size:1.5rem; text-align:right; background-color:#E8FAFF">
                '. $chat['timestamp'].':<br>'.$chat['msg']);
                echo('</li>');
                }
            }
        }
    }
    catch(Exception $e)
    {
        echo('No chats to show');
    }
}
session_close();
mysqli_close($conn);
?>