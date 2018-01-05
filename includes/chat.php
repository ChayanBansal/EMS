<?php
require('config.php');
session_start();
/*if($_POST['ed49c3fed75a513a79cb8bd1d4715d57']==1) //for super_admin side
{    
    if($_POST['chat']==1) //for displaying to superadmin
    {
        $get_active="SELECT operator_id, operator_name, operator_username FROM operators WHERE operator_active=1";
        $get_active_run=mysqli_query($conn,$get_active);
        while($active=mysqli_fetch_assoc($get_active_run))
        {
            $act_op=$active['operator_id'];
            $act_op_name=$active['operator_name'];
            $act_op_uname=$active['operator_username'];
            echo('<div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#'.$act_op.'"><center>'.$act_op_name.'</center></a>
            </h4>
            </div>
            <div id="'.$act_op.'" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="chat_display">');
            $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='ed49c3fed75a513a79cb8bd1d4715d57' OR sender='".$act_op_uname."') AND (receiver='ed49c3fed75a513a79cb8bd1d4715d57' OR receiver='".$act_op_uname."')";    
            $get_message_run=mysqli_query($conn,$get_message);
            while($msg=mysqli_fetch_assoc($get_message_run))
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                echo('</li>');
            }
                
            echo('</div>
                <div class="form-inline">
                <input type="text" id="'.$act_op_uname.'" class="form-control">
                <button class="btn btn-info" type="button" value="'.$act_op_uname.'" onclick="sendMessage(this.value)">Send</button></div>
            </div>
            </div>
        </div>');
        }
    }
    if($_POST['chat']==0 AND $_POST['sendmsg'])//for sending from superadmin
    {
        $receiver=$_POST['receiver'];
        $msg=$_POST['msg'];
        $send_msg="INSERT INTO chat(sender, receiver, msg) VALUES('ed49c3fed75a513a79cb8bd1d4715d57','$receiver','$msg')";
        $send_msg_run=mysqli_query($conn,$send_msg);
        
        
        $get_active="SELECT operator_id, operator_name, operator_username FROM operators WHERE operator_active=1";
        $get_active_run=mysqli_query($conn,$get_active);
        while($active=mysqli_fetch_assoc($get_active_run))
        {
            $act_op=$active['operator_id'];
            $act_op_name=$active['operator_name'];
            $act_op_uname=$active['operator_username'];
            echo('<div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#'.$act_op.'"><center>'.$act_op_name.'</center></a>
            </h4>
            </div>
            <div id="'.$act_op.'" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="chat_display">');
            $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='ed49c3fed75a513a79cb8bd1d4715d57' OR sender='".$act_op_uname."') AND (receiver='ed49c3fed75a513a79cb8bd1d4715d57' OR receiver='".$act_op_uname."')";    
            $get_message_run=mysqli_query($conn,$get_message);
            while($msg=mysqli_fetch_assoc($get_message_run))
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                echo('</li>');
            }
                
            echo('</div>
                <div class="form-inline">
                <input type="text" id="'.$act_op_uname.'" class="form-control">
                <button class="btn btn-info" type="button" value="'.$act_op_uname.'" onclick="sendMessage(this.value)">Send</button></div>
            </div>
            </div>
        </div>');
        }
    }
}
else
{
    if($_POST['chat']==1)//for displaying to operator
    {
        $get_self="SELECT operator_username, operator_name FROM operators WHERE operator_id=".$_SESSION['operator_id'];
        $get_self_run=mysqli_query($conn,$get_self);
        $self=mysqli_fetch_assoc($get_self_run);
        $self_uname=$self['operator_username'];
        $self_name=$self['operator_name'];

        //checking for super admin active
        $get_super="SELECT super_admin_id, super_admin_name, super_admin_username FROM super_admin WHERE active_flag=1";
        $get_super_run=mysqli_query($conn,$get_super);
        
        while($super=mysqli_fetch_assoc($get_super_run))
        {
            $sup_id=$super['super_admin_id'];
            $sup_name=$super['super_admin_name'];
            $sup_uname=$super['super_admin_username'];
            echo('<div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#'. $sup_id.'"><center>'.$sup_name.'</center></a>
            </h4>
            </div>
            <div id="'.$sup_id.'" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="chat_display">');
            $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='".$self_uname."' OR sender='".$sup_uname."') AND (receiver='".$self_uname."' OR receiver='".$sup_uname."')";    
            $get_message_run=mysqli_query($conn,$get_message);
            while($msg=mysqli_fetch_assoc($get_message_run))
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                echo('</li>');
            }
                
            echo('</div>
                <div class="form-inline">
                <input type="text" id="'.$sup_uname.'" class="form-control">
                <button class="btn btn-info" type="button" value="'.$sup_uname.'" onclick="sendMessage(this.value)">Send</button></div>
            </div>
            </div>
        </div>');
        }
        //superadmin active checking done

        //displaying other operators
        $get_active="SELECT operator_id, operator_name, operator_username FROM operators WHERE operator_active=1 AND operator_id<>".$_SESSION['operator_id'];
        $get_active_run=mysqli_query($conn,$get_active);
        while($active=mysqli_fetch_assoc($get_active_run))
        {
            $act_op=$active['operator_id'];
            $act_op_name=$active['operator_name'];
            $act_op_uname=$active['operator_username'];
            echo('<div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#'.$act_op.'"><center>'.$act_op_name.'</center></a>
            </h4>
            </div>
            <div id="'.$act_op.'" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="chat_display">');
            $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='".$self_uname."' OR sender='".$act_op_uname."') AND (receiver='".$self_uname."' OR receiver='".$act_op_uname."')";    
            $get_message_run=mysqli_query($conn,$get_message);
            while($msg=mysqli_fetch_assoc($get_message_run))
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                echo('</li>');
            }
                
            echo('</div>
                <div class="form-inline">
                <input type="text" id="'.$act_op_uname.'" class="form-control">
                <button class="btn btn-info" type="button" value="'.$act_op_uname.'" onclick="sendMessage(this.value)">Send</button></div>
            </div>
            </div>
        </div>');
        }
    }
    //displaying other operators done

    if($_POST['chat']==0 AND $_POST['sendmsg'])//sending message from operator
    {
        $get_self="SELECT operator_username, operator_name FROM operators WHERE operator_id=".$_SESSION['operator_id'];
        $get_self_run=mysqli_query($conn,$get_self);
        $self=mysqli_fetch_assoc($get_self_run);
        $self_uname=$self['operator_username'];
        $self_name=$self['operator_name'];
        
        $receiver=$_POST['receiver'];
        $msg=$_POST['msg'];
        $send_msg="INSERT INTO chat(sender, receiver, msg) VALUES('$self_uname','$receiver','$msg')";
        $send_msg_run=mysqli_query($conn,$send_msg);
        
         //checking for super admin active
         $get_super="SELECT super_admin_id, super_admin_name, super_admin_username FROM super_admin WHERE active_flag=1";
         $get_super_run=mysqli_query($conn,$get_super);
         
         while($super=mysqli_fetch_assoc($get_super_run))
         {
             $sup_id=$super['super_admin_id'];
             $sup_name=$super['super_admin_name'];
             $sup_uname=$super['super_admin_username'];
             echo('<div class="panel panel-default">
             <div class="panel-heading">
             <h4 class="panel-title">
                 <a data-toggle="collapse" data-parent="#accordion2" href="#'. $sup_id.'"><center>'.$sup_name.'</center></a>
             </h4>
             </div>
             <div id="'.$sup_id.'" class="panel-collapse collapse in">
             <div class="panel-body">
                 <div class="chat_display">');
             $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='".$self_uname."' OR sender='".$sup_uname."') AND (receiver='".$self_uname."' OR receiver='".$sup_uname."')";    
             $get_message_run=mysqli_query($conn,$get_message);
             while($msg=mysqli_fetch_assoc($get_message_run))
             {
                 echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                 echo('</li>');
             }
                 
             echo('</div>
                 <div class="form-inline">
                 <input type="text" id="'.$sup_uname.'" class="form-control">
                 <button class="btn btn-info" type="button" value="'.$sup_uname.'" onclick="sendMessage(this.value)">Send</button></div>
             </div>
             </div>
         </div>');
         }
        
        $get_active="SELECT operator_id, operator_name, operator_username FROM operators WHERE operator_active=1 AND operator_id<>".$_SESSION['operator_id'];
        $get_active_run=mysqli_query($conn,$get_active);
        while($active=mysqli_fetch_assoc($get_active_run))
        {
            $act_op=$active['operator_id'];
            $act_op_name=$active['operator_name'];
            $act_op_uname=$active['operator_username'];
            echo('<div class="panel panel-default">
            <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion2" href="#'.$act_op.'"><center>'.$act_op_name.'</center></a>
            </h4>
            </div>
            <div id="'.$act_op.'" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="chat_display">');
            $get_message="SELECT sender, msg, timestamp FROM chat WHERE (sender='$self_uname' OR sender='".$act_op_uname."') AND (receiver='$self_uname' OR receiver='".$act_op_uname."')";    
            $get_message_run=mysqli_query($conn,$get_message);
            while($msg=mysqli_fetch_assoc($get_message_run))
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'.$msg['sender'].' at '. $msg['timestamp'].' said: <br>'.$msg['msg']);
                echo('</li>');
            }
                
            echo('</div>
                <div class="form-inline">
                <input type="text" id="'.$act_op_uname.'" class="form-control">
                <button class="btn btn-info" type="button" value="'.$act_op_uname.'" onclick="sendMessage(this.value)">Send</button></div>
            </div>
            </div>
        </div>');
        }
    }
}*/

        
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
    echo('Sent');
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
    $last_record=mysqli_fetch_assoc($get_last_record_run);
    while($chat=mysqli_fetch_assoc($get_chat_run))
    {
        if($chat['sender']!=$self_username)
        {
            if($last_record['chat_id']==$chat['chat_id'])
            {
                echo('<li id="last_chat" class="list-group-item" style="font-size:1.5rem">'
                .$chat['sender'].' at '. $chat['timestamp'].' said: <br>'.$chat['msg']);
                echo('</li>');
            }
            else
            {
                echo('<li class="list-group-item" style="font-size:1.5rem">'
                    .$chat['sender'].' at '. $chat['timestamp'].' said: <br>'.$chat['msg']);
                echo('</li>');
            }
            
        }
        else if($chat['sender']==$self_username)
        {
            if($last_record['chat_id']==$chat['chat_id'])
            {
                echo('<li id="last_chat" class="list-group-item" style="font-size:1.5rem; text-align:right;">'
                .$chat['sender'].' at '. $chat['timestamp'].' said: <br>'.$chat['msg']);
                echo('</li>');    
            }
            else
            {
                
            echo('<li class="list-group-item" style="font-size:1.5rem; text-align:right;">'
            .$chat['sender'].' at '. $chat['timestamp'].' said: <br>'.$chat['msg']);
            echo('</li>');
            }
        }
    }
}
?>