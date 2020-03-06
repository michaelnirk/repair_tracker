{*smarty*}
<script src="js/modules/utility/showchangepassword.js"></script>
<link href="css/modules/utility/showchangepassword.css" rel="stylesheet">
<div class='show-change-password-wrapper-div contentContainer container topContainer'>
    <div class="row center" id="topRow">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="whiteText">Repair Tracker</h1>
            <p class="lead whiteText">Change Password for {$userName}</p>

            {if isset($messages) && count($messages) > 0}
                {foreach from=$messages item=message}
                    <div class="alert alert-success">{$message}</div>
                {/foreach}                
            {/if}
            {if isset($errors) && count($errors) > 0}
                {foreach from=$errors item=error}
                    <div class="alert alert-danger">{$error}</div>
                {/foreach}                
            {/if}
        </div>
    </div>
    <div class="row marginBottom">
        <div class="col-md-6 col-md-offset-2">
            <form class="form-horizontal marginTop" id="changePasswordForm" method="post" action="index.php?module=utility&action=changepassword">
                <div class="form-group form-group-sm">
                    <label class="control-label col-xs-4 whiteText"><span class="redText">*</span> Indicates required field</label>
                </div>
                <div class="form-group form-group-md">
                    <label for="oldpassword" class="control-label col-xs-4 whiteText"><span class="redText">* </span>Current Password</label>
                    <div class="col-xs-8">
                      <input type="password" class="form-control" name="oldpassword" id="oldPassword" placeholder="Old Password"/>
                    </div>              
                </div>
                <div class="form-group form-group-md">
                    <label for="newpassword1" class="control-label whiteText col-xs-4"><span class="redText">* </span>New Password</label>
                    <div class="col-xs-8">
                      <input class="form-control" type="password" name="newpassword1" id="newPassword1" placeholder="New Password"/>
                    </div>              
                </div>
                <div class="form-group form-group-md">
                    <label for="newpassword2" class="control-label whiteText col-xs-4"><span class="redText">* </span>Repeat New Password</label>
                    <div class="col-xs-8">
                      <input class="form-control" type="password" name="newpassword2" id="newPassword2" placeholder="Repeat New Password"/>
                    </div>
                </div>                
                <div class="col-xs-offset-4">
                    <button id="changePassword" type="button" class="btn btn-success btn-block">Submit</button>
                </div>  					
            </form>
        </div>
  	</div> 
</div>
