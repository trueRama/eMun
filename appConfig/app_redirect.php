<?php
function backHome($message,$BASEURL, $url){
    echo "<form id='the-form' 
      method='post' 
      enctype='multipart/form-data' 
      action='$BASEURL?page=$url'>\n";
    echo "<input type='hidden' name='message' value='$message'>\n";
    echo <<<ENDOFFORM
        <p id="the-button" style="display:none;">
        Click the button if page doesn't redirect within 3 seconds.
        <br><input type="submit" value="Click this button">
        </p>
        </form>
        <script type="text/javascript">
        function DisplayButton()
        {
           document.getElementById("the-button").style.display="block";
        }
        setTimeout(DisplayButton,3000);
        document.getElementById("the-form").submit();
        </script>
ENDOFFORM;
}