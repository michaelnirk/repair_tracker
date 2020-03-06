var ShowChangePassword = {
    init: function(){
        $(".contentContainer").css("min-height", $(window).height() - 52);
        
        $('.show-change-password-wrapper-div').off('click').on('click', function(e){
            if($(e.target).attr('id') === 'changePassword'){
                ShowChangePassword.validateForm();
            }
        });
    },
    
    validateForm: function(){
        var isValid = true;
        var oldPassword = $('#oldPassword').val();
        var newPassword1 = $('#newPassword1').val();
        var newPassword2 = $('#newPassword2').val();
        var errors = [];
        
        if(oldPassword.trim() === ''){
            errors.push('You must enter your current password.');
            isValid = false;
        } 
        
        if(newPassword1.trim() === ''){
            errors.push('You must enter your new password in both "New Password" fields.');
            isValid = false;
        } else if(newPassword2.trim() === ''){
            errors.push('You must enter your new password in both "New Password" fields.');
            isValid = false;
        } else if(newPassword1.trim() !== newPassword2.trim()){
            errors.push('The new passwords you have entered do not match. Please enter them again.');
            isValid = false;
        }
        
        
        if(isValid){
            $('#changePasswordForm').submit();
        } else {
            var message = '';
            for(i = 0; i < errors.length; i++){
                message += errors[i] + '\n';
            }
            alert(message);
        }
    }
};

$(document).ready(function(){
    if($('.show-change-password-wrapper-div').length){
        ShowChangePassword.init();
    }
});

