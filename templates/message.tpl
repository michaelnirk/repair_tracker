<div id="messages">
  {if count($messages['errors']) > 0}
      {foreach $messages['errors'] as $error}
        <div class='message error'>{$error}</div>
      {/foreach}
  {/if}
  {if count($messages['success']) > 0}
      {foreach $messages['success'] as $success}
        <div class="message success">{$success}</div>
      {/foreach}
  {/if}
  {if count($messages['caution']) > 0}
      {foreach $messages['caution'] as $caution}
        <div class="message caution">{$caution}</div>
      {/foreach}
  {/if}
</div>
<div id="jsMessagesWrapper"></div>